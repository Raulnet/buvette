<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 14/06/15
 * Time: 14:09
 */

namespace buvette\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Silex\Application;

class RecipeType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('primProductQuantity', 'number', array(
            'label' => 'quantité :',
            'precision' => 2,
            'attr' => array('class' => 'form-control')
        ))->add('enregistrer', 'submit', array(
            'attr' => array('class' => 'btn btn-success')
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'recipe';
    }

}