<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 22/06/15
 * Time: 22:20
 */

namespace buvette\Model\Generator;


class EntityDaoContentGenerator extends AbstractGenerator{

    /**
     * @return string
     */
    public function getRoot(){

        return __DIR__ . '/../../DAO/Generated/';
    }

    /**
     * @param $table
     *
     * @return string
     */
    public function getTitleFile($table){

        return $this->getTitleToCamelCase($table['title']);
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

    public function getContentDaoFile($table){
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