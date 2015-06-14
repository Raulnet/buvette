<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 17:58
 */

namespace buvette\Form\Type;

use Silex\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ProductType extends AbstractType {

    /**
     * @var Application
     */
    private $app;

    function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
            'label' => 'Titre :',
            'attr'  => array(
                'class' => 'form-control'
            )
        ))->add('categoryId', 'choice', array(
                'choices'   => $this->arrayChoices(),
                'expanded'  => false,
                'multiple'  => false,
                'label'     => 'Categorie :',
                'attr'      => array(
                    'class' => 'form-control'
                )
            )
        )->add('enregistrer', 'submit', array(
                'attr' => array('class' => 'btn btn-success')
            )

        );
    }

    public function getName()
    {
        return 'product';
    }

    private function arrayChoices(){

        $categories = $this->app['zdao.catProducts']->findAll();

        $arrayChoices = array();
        foreach($categories as $category){

            $arrayChoices[$category->getId()] = $category->getTitle();
        }

        return $arrayChoices;

    }

}