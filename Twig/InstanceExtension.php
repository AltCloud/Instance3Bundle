<?php
namespace AltCloud\Instance3Bundle\Twig;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

class InstanceExtension extends Twig_Extension
{
    public function getFilters()
    {
        return array(
            'serialize' => new Twig_Filter_Method($this, 'serializeFilter'),
            'unserialize' => new Twig_Filter_Method($this, 'unserializeFilter'),
        );
    }

    public function unserializeFilter($serialized)
    {
		$prepserialized = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serialized ); 
        $unserialized = unserialize($prepserialized);

        return $unserialized;
    }
    
    public function serializeFilter($unserialized)
    {
        $serialized = serialize($unserialized);

        return $serialized;
    }
    
    public function getName()
    {
        return 'instance_extension';
    }
}
