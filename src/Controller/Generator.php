<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 21/06/15
 * Time: 13:54
 */
namespace buvette\Controller;

use Silex\Application;

use PDO;

class Generator
{


    public function indexAction(Application $app)
    {
        $bdd     = new PDO('mysql:host=127.0.0.1;dbname=buvette;charset=utf8', 'Raulnet', '');
        $tables  = $bdd->query('SHOW TABLES FROM buvette');
        $schemas = array();
        foreach ($tables as $table) {
            $schemas[$table['Tables_in_buvette']] = array('title' => $table['Tables_in_buvette']);
        }
        $schema = array();
        foreach ($schemas as $table) {
            $title       = $table['title'];
            $constraints = $this->getConstraint($title);
            $columns = $bdd->query("SHOW COLUMNS FROM " . $title . "");
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
        $rootFolder = __DIR__ . '/../Entity/Generated/';
        echo '<pre>';
        print_r($schema);
        if (!file_exists($rootFolder)) {
            mkdir($rootFolder, 0777, true);
        }
        foreach ($schema as $table) {
            $this->saveFileEntity($rootFolder, $table);
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
        $bdd         = new PDO('mysql:host=127.0.0.1;dbname=buvette;charset=utf8', 'Raulnet', '');
        $cons        = $bdd->query('select *
                              from information_schema.table_constraints
                              where table_schema = schema()
                              and table_name = "' . $table . '"');
        $constraints = array();
        foreach ($cons as $row) {
            {
                $constraintName = $row['CONSTRAINT_NAME'];
                if ($constraintName !== 'PRIMARY') {
                    $constraint                        = $bdd->query("select * from information_schema.key_column_usage
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
        // add namespace
        $content .= 'namespace buvette\Entity;'."\n"."\n";
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
            $content .= ($constraints['key'] === true ? '    * #Primary key'."\n".'    *'."\n" : null);
            $content .= (array_key_exists('relation', $constraints) ? '    * #Relation '.$constraints['relation']."\n" : null);
            $content .= (array_key_exists('table_target', $constraints) ? '    * #Table '.$constraints['table_target'].' '. $constraints['column_target'] ."\n".'     *'."\n" : null);
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

}