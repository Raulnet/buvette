<?php
/**
 * Created by PhpStorm.
 * User: XVI
 * Date: 01/03/15
 * Time: 17:30
 */

namespace buvette\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text')
        ->add('dateStart', 'date', array(
            'input'  => 'datetime',
            'widget' => 'choice'))
        ->add('dateEnd', 'date', array(
            'input'  => 'datetime',
            'widget' => 'choice'))
        ;
    }

    public function getName()
    {
        return 'event';
    }
}


