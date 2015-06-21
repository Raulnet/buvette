<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 21/06/15
 * Time: 13:54
 */
namespace buvette\Controller;

use PDO;

class Generator
{

    /**
     * @var PDO
     */
    private $bdd;

    function __construct()
    {
        $this->bdd = new PDO('mysql:host=127.0.0.1;dbname=buvette;charset=utf8', 'Raulnet', '');
    }

    /**
     * @return string
     */
    public function indexAction()
    {
        $tables  = $this->bdd->query('SHOW TABLES FROM buvette');
        $schemas = array();
        foreach ($tables as $table) {
            $schemas[$table['Tables_in_buvette']] = array('title' => $table['Tables_in_buvette']);
        }
        $schema = array();
        foreach ($schemas as $table) {
            $title       = $table['title'];
            $constraints = $this->getConstraint($title);
            $columns = $this->bdd->query("SHOW COLUMNS FROM " . $title . "");
            $column  = array();
            if ($columns) {
                foreach ($columns as $data) {
                    $column[$data['Field']] = array(
                        'title'   => $data['Field'],
                        'Type'    => $data['Type'],
                        'Null'    => $data['Null'],
                        'Key'     => $data['Key'],
                        'Default' => $data['Default'],
                        'Extra'   => $data['Extra']
                    );
                    if (array_key_exists($data['Field'], $constraints)) {
                        $column[$data['Field']]['Constraint'] = $constraints[$data['Field']];
                    }
                }
                $schema[$title] = array(
                    'title'   => $title,
                    'columns' => $column
                );
            }
        }

        // ===== Generate Entity =====
        $rootFolder = __DIR__ . '/../Entity/Generated/';
        echo '<pre>';
        print_r($schema);
        if (!file_exists($rootFolder)) {
            mkdir($rootFolder, 0777, true);
        }

        $this->saveFileInterfaceEntity($rootFolder);

        foreach ($schema as $table) {
            $this->saveFileEntity($rootFolder, $table);
        }
        // Generate DAO =====
        $rootFolder = __DIR__ . '/../DAO/Generated/';
        if (!file_exists($rootFolder)) {
            mkdir($rootFolder, 0777, true);
        }
        foreach ($schema as $table) {
            $this->saveFileDao($rootFolder, $table);
        }

        return 'ok';
    }

    /**
     * @param $table
     *
     * @return array
     */
    private function getConstraint($table)
    {
        $cons        = $this->bdd->query('select *
                              from information_schema.table_constraints
                              where table_schema = schema()
                              and table_name = "' . $table . '"');
        $constraints = array();
        foreach ($cons as $row) {
            {
                $constraintName = $row['CONSTRAINT_NAME'];
                if ($constraintName !== 'PRIMARY') {
                    $constraint = $this->bdd->query("select * from information_schema.key_column_usage
                                                where  table_schema = schema()
                                                and table_name = '" . $table . "'
                                                and constraint_name = '" . $constraintName . "'");
                    $data                              = $constraint->fetch();
                    $constraints[$data['COLUMN_NAME']] = array(
                        "column_name"            => $data['COLUMN_NAME'],
                        "referenced_table_name"  => $data['REFERENCED_TABLE_NAME'],
                        "referenced_column_name" => $data['REFERENCED_COLUMN_NAME'],
                    );
                }

            }
        }

        return $constraints;
    }

    /**
     * @param $rootFolder
     *
     * @return bool
     */
    private function saveFileInterfaceEntity($rootFolder)
    {

        $file = fopen($rootFolder.'Entity.php', 'w+');
        fputs($file, $this->getContentInterfaceEntityFile());
        fclose($file);

        return true;
    }

    /**
     * @param $rootFolder
     * @param $table
     *
     * @return bool
     */
    private function saveFileEntity($rootFolder, $table)
    {
        $title = $this->getTitleToCamelCase($table['title']);
        $file = fopen($rootFolder . $title . '.php', 'w+');
        fputs($file, $this->getContentEntityFile($table));
        fclose($file);

        return true;
    }

    /**
     * @param $rootFolder
     * @param $table
     *
     * @return bool
     */
    private function saveFileDao($rootFolder, $table)
    {
        $title = $this->getTitleToCamelCase($table['title']);
        $file = fopen($rootFolder . $title . '.php', 'w+');
        fputs($file, $this->getContentDaoFile($table));
        fclose($file);

        return true;
    }

    /**
     * @param $title
     *
     * @return string
     */
    private function getTitleToCamelCase($title)
    {
        $titleToCamelCase = '';
        $explo = explode('_', $title);
        // supprime l'index table si celui-ci a une taille inferieur ou = a 3
        if (strlen($explo[0]) <= 3) {
            unset($explo[0]);
        }
        foreach ($explo as $word) {
            $titleToCamelCase .= ucfirst(strtolower($word));
        }

        return $titleToCamelCase;
    }

    /**
     * @param $column
     *
     * @return array
     */
    private function getConstraintsByColumn($column){
        $constraint = array();
        $constraint['title'] = lcfirst($this->getTitleToCamelCase($column['title']));
        $replace = array('(', ')');
        $data = str_replace($replace, ' ', $column['Type']);
        $dataArray = explode(' ', $data);

        $constraint['type'] = $dataArray[0];

        $constraint['type'] = str_replace('varchar', 'string', $constraint['type']);
        $constraint['type'] = str_replace('datetime', '\DateTime', $constraint['type']);

        if(array_key_exists(1, $dataArray)){
            $constraint['limit'] = $dataArray[1];
        }
        $constraint['null'] = ($column['Null'] == 'YES' ?  true :  false);;
        $constraint['key'] = ($column['Key'] == 'PRI' ?  true : false);
        if(array_key_exists('Constraint', $column)){
            $constraint['relation'] = ($column['Key'] == 'MUL' ?  'Many To Many' : 'Many To One');
            $constraint['table_target'] = $column['Constraint']['referenced_table_name'];
            $constraint['column_target'] = $column['Constraint']['referenced_column_name'];
        }

        return $constraint;
    }

    /**
     * @param $constraint
     *
     * @return array
     */
    private function getAssert($constraint){

        $assert = array();

        if(array_key_exists('limit', $constraint)){
            $assert[] = '$metadata->addPropertyConstraint("'.$constraint['title'] .'", new Assert\Length(array("max" => '. $constraint['limit'].', "maxMessage" => "trop long")));';
        }
        if(array_key_exists('null', $constraint) && $constraint['null'] === false ){
            $assert[] = '$metadata->addPropertyConstraint("'.$constraint['title'] .'", new Assert\NotBlank(array("message" => "Not null")));';
        }


        return $assert;
    }


    /**
     * @param $table
     *
     * @return string
     */
    private function getContentEntityFile($table)
    {
        $dateTime = false;

        $content ='<?php'."\n";
        $content .= $this->getStartEntityCommentFile($table['title']);
        // add namespace
        $content .= 'namespace buvette\Entity\Generated;'."\n"."\n";
        // add assert
        $content .= 'use Symfony\Component\Validator\Mapping\ClassMetadata;'."\n";
        $content .= 'use Symfony\Component\Validator\Constraints as Assert;'."\n"."\n"."\n";
        //add start class
        $content .= 'class '. $this->getTitleToCamelCase($table['title']).' implements Entity'."\n";
        $content .= '{'."\n";
        // add Var
        foreach($table['columns'] as $var){
            $constraints = $this->getConstraintsByColumn($var);
            if($constraints['type'] === '\DateTime'){
                $dateTime = true;
            }
            $content .= "\n".'   /**'."\n";
            $content .= ($constraints['key'] === true ? '    * Primary key'."\n".'    *'."\n" : null);
            $content .= (array_key_exists('relation', $constraints) ? '    * Relation '.$constraints['relation']."\n" : null);
            $content .= (array_key_exists('table_target', $constraints) ? '    * Table-target '.$constraints['table_target'].' '. $constraints['column_target'] ."\n".'    *'."\n" : null);
            $content .= '    * @var '. $constraints['type'] ."\n";
            $content .= '    */' ."\n";
            $content .= '   private $'.lcfirst($this->getTitleToCamelCase($var['title'])) .' = null;' ."\n";
        }
        // add construct Datetime
        if($dateTime === true){
            $content .= "\n".'   /**'."\n";
            $content .= '    * set default var \Datetime ' ."\n";
            $content .= '    */' ."\n";
            $content .= '   function __construct()' ."\n";
            $content .= '   {' ."\n";
            foreach($table['columns'] as $var){
                $constraints = $this->getConstraintsByColumn($var);
                if($constraints['type'] == '\DateTime'){
                    $content .= '       $this->'.lcfirst($this->getTitleToCamelCase($var['title'])) .' = new \DateTime("now");' ."\n";
                }
            }
            $content .= '   }' ."\n";
        }
        // add Assert Constraint
        $content .= "\n".'   /**'."\n";
        $content .= '    * @param ClassMetadata $metadata'."\n";
        $content .= '    */' ."\n";
        $content .= '    static public function loadValidatorMetadata(ClassMetadata $metadata)' ."\n";
        $content .= '    {'."\n";
            foreach($table['columns'] as $var) {
                $asserts = $this->getAssert($this->getConstraintsByColumn($var));
                foreach($asserts as $assert){
                    $content .='            '.$assert."\n";
                }
            }

        $content .= '    }' ."\n";
        //add getter Setter
        foreach($table['columns'] as $var){
            $constraints = $this->getConstraintsByColumn($var);
            // add getter
            $content .= "\n".'   /**'."\n";
            $content .= '    * @return '.$constraints['type']."\n";
            $content .= '    */' ."\n";
            $content .= '   public function get'.$this->getTitleToCamelCase($var['title']).'()'."\n";
            $content .= '   {'."\n";
            $content .= '       return $this->'.lcfirst($this->getTitleToCamelCase($var['title'])).';'."\n";
            $content .= '   }'."\n";
            //add setter
            $content .= "\n".'   /**'."\n";
            $content .= '    * @param '.$constraints['type'].' $'.lcfirst($this->getTitleToCamelCase($var['title']))."\n";
            $content .= '    */' ."\n";
            $content .= '   public function set'.$this->getTitleToCamelCase($var['title']).'($'.lcfirst($this->getTitleToCamelCase($var['title'])).')'."\n";
            $content .= '   {'."\n";
            $content .= '       $this->'.lcfirst($this->getTitleToCamelCase($var['title'])).' = $'.lcfirst($this->getTitleToCamelCase($var['title'])).';'."\n";
            $content .= '   }'."\n";
        }

        //add getArray for Entity interface
        $content .= "\n".'   /**'."\n";
        $content .= '    * @return array Entity '."\n";
        $content .= '    */' ."\n";
        $content .= '   public function getArray()'."\n";
        $content .= '   {'."\n";
        $content .= '       $entity = array('."\n";
        foreach($table['columns'] as $var){
            $content .='            "'.$var['title'].'" => $this->'.lcfirst($this->getTitleToCamelCase($var['title'])).','."\n";
        }
        $content .= '       );'."\n";
        //add string converter \datetime
        foreach($table['columns'] as $var){
            $constraints = $this->getConstraintsByColumn($var);
            if($constraints['type'] == '\DateTime'){
                $content .= '       if($this->'.lcfirst($this->getTitleToCamelCase($var['title'])) .' instanceof \DateTime){' ."\n";
                $content .= '           $entity["'.$var['title'] .'"] = date_format($this->dateStart, "Y-m-d H:i:s");'."\n";
                $content .= '       }'."\n";
            }
        }
        $content .= '       return $entity;'."\n";
        $content .= '   }'."\n";

        // Close Entity file
        $content .= "\n".'}'."\n";

        return $content;
    }

    /**
     * CREATE INTERFACE ENTITY
     *
     * @return string
     */
    private function getContentInterfaceEntityFile()
    {
        // start file.php
        $content = '<?php'."\n";
        $content .= $this->getStartEntityCommentFile();
        $content .= 'namespace buvette\Entity;'."\n\n\n";
        $content .= 'interface Entity {'."\n\n";
        $content .= '    /**'."\n";
        $content .= '     * @return array'."\n";
        $content .= '     */'."\n";
        $content .= '    public function getArray();'."\n";

        // Close Entity file
        $content .= "\n".'}';


        return $content;
    }

    /**
     * @param string $title
     *
     * @return string
     */
    private function getStartEntityCommentFile($title = 'Interface'){

        $date = new \DateTime('now');
        $comment = '';
        $comment .='/**'."\n";
        $comment .=' * Entity '.$this->getTitleToCamelCase($title)."\n";
        $comment .=' * Auto Generate :'.date_format($date, "Y-m-d H:i:s")."\n";
        $comment .=' * '.$title."\n";
        $comment .=' */'."\n";

        return $comment;
    }

    /**
     * @param string $title
     *
     * @return string
     */
    private function getStartDaoCommentFile($title = 'Interface'){

        $date = new \DateTime('now');
        $comment = '';
        $comment .='/**'."\n";
        $comment .=' * Data Access Object DAO '.$this->getTitleToCamelCase($title)."\n";
        $comment .=' * Auto Generate :'.date_format($date, "Y-m-d H:i:s")."\n";
        $comment .=' * '.$title."\n";
        $comment .=' */'."\n";

        return $comment;
    }

    // ================================================================================
    // ================================================================================
    // ================================================================================

    private function getContentDaoFile($table){
        // start file.php
        $content = '';
        $content .= '<?php'."\n";
        $content .= $this->getStartDaoCommentFile($table['title']);
        $content .= 'namespace buvette\DAO\Generated;'."\n\n";
        $content .= 'use buvette\Entity\Generated\\'.$this->getTitleToCamelCase($table['title']).';'."\n\n";
        $content .= 'class '.$this->getTitleToCamelCase($table['title']).'ZDAO extends ZDAO {'."\n\n";
        // Add var Table
        $content .= '    /**'."\n";
        $content .= '     * @var string table Entity'."\n";
        $content .= '     */'."\n";
        $content .= '    protected $table = "'.$table['title'].'";'."\n\n";
        // Add var Primary Key
            $iPos = 0;
            $primaryKey = array('$primaryKey', '$secondaryKey');
            foreach($table['columns'] as $var){
                if($var['Key'] === 'PRI' && $iPos < 2){
                    $content .= '    /**'."\n";
                    $content .= '     * @var string '.$primaryKey[$iPos]."\n";
                    $content .= '     */'."\n";
                    $content .= '    protected '.$primaryKey[$iPos].' = "'.$var['title'].'";'."\n\n";
                    $iPos++;
                }
            }
        // Add construct
        $content .= '    /**'."\n";
        $content .= '     * @param $configArray'."\n";
        $content .= '     */'."\n";
        $content .= '    function __construct($configArray)'."\n";
        $content .= '    {'."\n";
        $content .= '        parent::__construct($configArray);'."\n";
        $content .= '    }'."\n\n";
        // Add Build Entity Object
        $content .= '    /**'."\n";
        $content .= '     * @param $row'."\n";
        $content .= '     * @return '.$this->getTitleToCamelCase($table['title'])."\n";
        $content .= '     */'."\n";
        $content .= '    protected function buildZEntityObject($row)'."\n";
        $content .= '    {'."\n";
        $content .= '        $entity = new '. $this->getTitleToCamelCase($table['title']).'();'."\n";
            foreach($table['columns'] as $var){
                $content .= '        $entity->set'.$this->getTitleToCamelCase($var['title']).'($row["'.$var['title'].'"]);'."\n";
            }
        $content .= '        return $entity;'."\n";
        $content .= '    }'."\n";

          // Close Entity file
        $content .= "\n".'}';
        return $content;
    }
}