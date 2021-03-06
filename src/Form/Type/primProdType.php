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

    public function __construct(Application $app)
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
            ->add('categoriesId', 'choice', array(
                'choices' => $this->getCategoryChoice(),
                'expanded' => false,
            ))
            ->add('unitiesId', 'choice', array(
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

        $data = $this->app['EM']->get('CategoriesPrimProductsZEM')->findAll();

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

        $data = $this->app['EM']->get('UnitiesZEM')->findAll();

        $unities =array();

        foreach($data as $unit){

            $unities[$unit->getId()] = $unit->getTitle();
        }

        return $unities;
    }

}