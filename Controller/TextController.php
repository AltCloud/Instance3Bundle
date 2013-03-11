<?php

namespace AltCloud\Instance3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AltCloud\Instance3Bundle\Entity\Text;
use AltCloud\Instance3Bundle\Form\TextType;

/**
 * Text controller.
 *
 */
class TextController extends Controller
{

	public function renderPartialAction($id)
	{
			$text = $this->getDoctrine()
				->getRepository('ACInst3Bundle:Text')
				->find($id);

			if (!$text) {
				throw $this->createNotFoundException('No text found for id '.$id);
			}
		
        	return $this->render('ACInst3Bundle:Text:renderPartial.html.twig', array('text' => $text));
    }

	public function renderAction($id, $node=false)
	{
			$text = $this->getDoctrine()
				->getRepository('ACInst3Bundle:Text')
				->find($id);

			if (!$text) {
				throw $this->createNotFoundException('No text found for id '.$id);
			}
	
			if (is_object($node)){
				$nodetpl = $node->getSite()->getDeftemp();
				if(is_string($nodetpl))
					$tpl=$nodetpl;
			}
			
			if(!isset($tpl)){
				// Determine tpl based on request uri, if possible
			}
			
			if(!isset($tpl)){
				// Use default tpl
				// FIXME: Move to setting somewhere
				$tpl="JMORGSTJMBundle::layout.html.twig";
			}
		
        	return $this->render('ACInst3Bundle:Text:render.html.twig', array('text' => $text, 'tpl' => $tpl, 'node' => $node));
    }

}
