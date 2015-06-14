<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 13/06/15
 * Time: 18:00
 */

namespace buvette\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CategoryProductsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', array(
                        'label' => 'Titre :',
                        'attr' => array(
                            'class' => 'form-control'
                        )
                ))
                ->add('enregistrer', 'submit', array(
                    'attr' => array('class' => 'btn btn-success')
                ));
    }

    public function getName()
    {
        return 'categoryProducts';
    }

}