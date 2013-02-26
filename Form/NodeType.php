<?php

namespace AltCloud\Instance3Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('machine_name')
            ->add('mode')
            ->add('target_controller')
            ->add('target_params', 'text', array(
    							    'required' => false
									))
            ->add('label', 'text', array(
    							    'required' => false
									))
            ->add('title')
            ->add('site', 'entity', array(
    								'class' => 'ACInst3Bundle:Site',
    								'property' => 'name'
									)
				 )
			->add('parent', 'entity', array(
    								'class' => 'ACInst3Bundle:Node',
//    							    'empty_value' => "None",
    							    'required' => false,
    								'property' => 'title'	
									)
				 );
    }

    public function getName()
    {
        return 'altcloud_instance3bundle_nodetype';
    }
}
