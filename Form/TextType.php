<?php

namespace AltCloud\Instance3Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TextType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('content')
        ;
    }

    public function getName()
    {
        return 'altcloud_instance3bundle_texttype';
    }
}
