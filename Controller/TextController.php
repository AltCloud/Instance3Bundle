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


    /**
     * Lists all Text entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ACInst3Bundle:Text')->findAll();

        return $this->render('ACInst3Bundle:Text:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Text entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Text')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Text entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3Bundle:Text:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Text entity.
     *
     */
    public function newAction()
    {
        $entity = new Text();
        $form   = $this->createForm(new TextType(), $entity);

        return $this->render('ACInst3Bundle:Text:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Text entity.
     *
     */
    public function createAction()
    {
        $entity  = new Text();
        $request = $this->getRequest();
        $form    = $this->createForm(new TextType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_text_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ACInst3Bundle:Text:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Text entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Text')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Text entity.');
        }

        $editForm = $this->createForm(new TextType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3Bundle:Text:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Text entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Text')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Text entity.');
        }

        $editForm   = $this->createForm(new TextType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_text_edit', array('id' => $id)));
        }

        return $this->render('ACInst3Bundle:Text:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Text entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ACInst3Bundle:Text')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Text entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_text'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
