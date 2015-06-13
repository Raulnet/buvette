<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 07/06/15
 * Time: 20:56
 */

namespace buvette\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'text')
                ->add('perso', 'text')
                ->add('area', 'textarea')
                ->add('textarea', 'textarea')
                ->add('integer', 'integer')
                ->add('checkbox', 'checkbox')
                ->add('date', 'date', array(
                'input'  => 'datetime',
                'widget' => 'choice'))

        ;
    }

    public function getName()
    {
        return 'test';
    }

}