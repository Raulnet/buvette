<?php
/**
 * Created by PhpStorm.
 * User: laurentnegre
 * Date: 31/05/15
 * Time: 10:25
 */

namespace buvette\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UnityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text');
    }

    public function getName()
    {
        return 'unity';
    }
}