<?php

namespace AltCloud\Instance3Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AltCloud\Instance3Bundle\Entity\Node;
use Symfony\Component\HttpFoundation\Response;
use AltCloud\Instance3Bundle\Form\NodeType;

/**
 * Node controller.
 *
 */
class NodeController extends Controller
{

    public function listAction($node=false,$parent=false,$_format=false, $displayoptions=false)
    {
        $em = $this->getDoctrine()->getEntityManager();

		if(is_int($parent)){
        	$nodes = $em->getRepository('ACInst3Bundle:Node')->findBy( array( 'parent' => $parent ) );
        }else{
		  	$nodes = $em->getRepository('ACInst3Bundle:Node')->findAll();
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
			$tpl="JMORGJMFBundle::layout.html.twig";
		}
		
//		if($_format && $_format == 'rss' ){
//			$response = $this->render("ACInst3EventBundle:Event:list.rss.twig", array('events' => $events));
//			$response->headers->set('Content-Type', 'application/rss+xml');
//		
//	        return $response;
//		}else
	        return $this->render("ACInst3Bundle:Node:list.html.twig", array('nodes' => $nodes, 'tpl' => $tpl, 'node' => $node, 'displayoptions' => $displayoptions));

    }
    
    public function listPartialAction($parent=false, $displayoptions=false)
    {
        $em = $this->getDoctrine()->getEntityManager();

		if(is_int($parent)){
        	$nodes = $em->getRepository('ACInst3Bundle:Node')->findBy( array( 'parent' => $parent ) );
        }else{
		  	$nodes = $em->getRepository('ACInst3Bundle:Node')->findAll();
		}
		
        return $this->render('ACInst3Bundle:Node:listPartial.html.twig', array('nodes' => $nodes, 'displayoptions' => $displayoptions));

    }
    /**
     * Forwards the current request to the specified node
     *
     */
	public function forwardAction($id = false, $mname = false, $params = false)
	{
		
		if(!$id && !$mname){
		    throw $this->createNotFoundException('No ID or MName Specified');
		}

		if($mname != false){	
			$node = $this->getDoctrine()
				->getRepository('ACInst3Bundle:Node')
				->findOneBy(array('machine_name' => $mname));
	
			if (!$node) {
				throw $this->createNotFoundException("No Node found. (MName: $mname)".var_dump($node));
			}		
		}else{	
			$node = $this->getDoctrine()
				->getRepository('ACInst3Bundle:Node')
				->find($id);		
	
			if (!$node) {
				throw $this->createNotFoundException("No Node found. (ID: $id)");
			}
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

		// Reassign vars from node to prepare for node rendering
		$node_payload['controller']	=$node->getTargetController();
		$node_payload['mode']		=$node->getMode();
		$node_payload['vars']		=unserialize($node->getTargetParams());
		$node_payload['vars']['node']=$node;
		
		// Supplement the vars with params from the request
		if($params && is_string($params)){
			// Order $params into $extravars array
			$params_array=explode('/', $params);
			if(count($params_array) == 1){
				$extravars['id'] = $params_array[0];
			}elseif(count($params_array) == 1){
				$extravars[$params_array[0]] = $params_array[0];
			}
			// Set $extravars items as vars in $node_payload
			foreach($extravars as $key => $value){
				$node_payload['vars'][$key] = $value; 
			}
		}
	
		if($node_payload['mode'] == 'forward')
			return $this->forward($node_payload['controller'],$node_payload['vars']);
    	elseif($node_payload['mode'] == 'display')
        	return $this->render('ACInst3Bundle:Node:display.html.twig', array(
            	'controller' => $node_payload['controller'],
            	'controllervars' => $node_payload['vars'],
            	'tpl' => $tpl
	        ));
		else
			throw $this->createNotFoundException("No suitable rendermode found for mode: '".$node_payload['mode']."'.");
		
    }
    	
    /**
     * Lists all Node entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ACInst3Bundle:Node')->findAll();

        return $this->render('ACInst3Bundle:Node:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Node entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3Bundle:Node:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Node entity.
     *
     */
    public function newAction()
    {
        $entity = new Node();
        $form   = $this->createForm(new NodeType(), $entity);

        return $this->render('ACInst3Bundle:Node:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Node entity.
     *
     */
    public function createAction()
    {
        $entity  = new Node();
        $request = $this->getRequest();
        $form    = $this->createForm(new NodeType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_node_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ACInst3Bundle:Node:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Node entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $editForm = $this->createForm(new NodeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3Bundle:Node:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Node entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Node entity.');
        }

        $editForm   = $this->createForm(new NodeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_node_edit', array('id' => $id)));
        }

        return $this->render('ACInst3Bundle:Node:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Node entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ACInst3Bundle:Node')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Node entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_node'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
