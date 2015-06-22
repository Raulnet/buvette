<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 21/06/15
 * Time: 13:54
 */
namespace buvette\Controller;

use buvette\Model\Generator\Generator as EntityGenerator;

class Generator
{

    /**
     * @return string
     */
    public function indexAction()
    {
        $generator = new EntityGenerator();
        if($generator->generate()){
            return true;
        }
        return false;
    }

}