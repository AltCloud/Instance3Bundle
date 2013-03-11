<?php

namespace AltCloud\Instance3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AltCloud\Instance3Bundle\Entity\Site;
use AltCloud\Instance3Bundle\Form\SiteType;

/**
 * Site controller.
 *
 */
class SiteController extends Controller
{
    /**
     * Forwards the request to the site's entry node
     *
     */
	public function entryAction($url = false)
	{
		if(!$url)
			$url = 'fullfilliant.org';

		$site = $this->getDoctrine()
			->getRepository('ACInst3Bundle:Site')
			->findOneBy(array('url' => $url));

		if (!$site) {
			throw $this->createNotFoundException("No Site found. (URL: $url)");
		}
		
		$entrynode_id = $site->getEntrynode()->getId();
			
		return $this->forward('ACInst3Bundle:Node:forward',array('id' => $entrynode_id));

    }
}
