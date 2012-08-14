<?php

namespace AltCloud\Instance3Bundle\Controller;

use AltCloud\Instance3Bundle\Entity\Text;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TextController extends Controller
{

	public function showAction($id, $node=false)
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
		
		// do something, like pass the $text object into a template

        #return new Response('<html><body><h1>'.$text->getTitle().
        #					'</h1><p><b>'.$text->getTeaser().
        #					'</b></p>'.$text->getContent().'</body></html>');
        return $this->render('ACInst3Bundle:Text:show.html.twig', array('text' => $text, 'tpl' => $tpl, 'node' => $node));
    	}

}
