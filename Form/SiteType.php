<?php

namespace AltCloud\Instance3Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('deftemp')
			->add('entrynode', 'entity', array(
    								'class' => 'ACInst3Bundle:Node',
    							    'required' => false,
    								'property' => 'title'	
									)
				 );            
        ;
    }

    public function getName()
    {
        return 'altcloud_instance3bundle_sitetype';
    }
}
