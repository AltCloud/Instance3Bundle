<?php
namespace AltCloud\Instance3Bundle\Menu;

use Knp\Menu\FactoryInterface;
use AltCloud\Instance3Bundle\Entity\Node;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware
{

	private $factory;

    public function MainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setCurrentUri($this->container->get('request')->getRequestUri());
        
        $em = $this->container->get('doctrine.orm.entity_manager');
		$repository = $em->getRepository('ACInst3Bundle:Node');
		$children = $repository->findBy(array('parent' => $options['parent']));
		
        foreach ($children as $child){
	        $label	=$child->getLabel();
    	    $id		=$child->getId();
    	    $mname	=$child->getMachineName();

	        if($label && $label != "")
                $menu->addChild($label, array('uri' => $_SERVER['SCRIPT_NAME'].'/show/'.$mname));
		}
        return $menu;
    }
}