<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 13:29
 */

namespace buvette\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Silex\Application;

class PrimProdType extends AbstractType {

    /**
     * @var Application
     */
    private $app;

    function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text')
            ->add('categoryId', 'choice', array(
                'choices' => $this->getCategoryChoice(),
                'expanded' => false,
            ))
            ->add('unityId', 'choice', array(
                'choices' => $this->getUnityChoice(),
                'expanded' => false,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'primaProducts';
    }

    /**
     * @return array
     */
    private function getCategoryChoice(){

        $data = $this->app['zdao.catPrimProds']->findAll();

        $categories =array();

        foreach($data as $cat){

            $categories[$cat->getId()] = $cat->getTitle();
        }

        return $categories;
    }

    /**
     * @return array
     */
    private function getUnityChoice(){

        $data = $this->app['zdao.unities']->findAll();

        $unities =array();

        foreach($data as $unit){

            $unities[$unit->getId()] = $unit->getTitle();
        }

        return $unities;
    }






} // END CLASS !!