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
			$url = $_SERVER['SERVER_NAME'];

		$site = $this->getDoctrine()
			->getRepository('ACInst3Bundle:Site')
			->findOneBy(array('url' => $url));

		if (!$site) {
			throw $this->createNotFoundException("No Site found. (URL: $url)");
		}
		
		$entrynode_id = $site->getEntrynode()->getId();
			
		return $this->forward('ACInst3Bundle:Node:forward',array('id' => $entrynode_id));

    }
    /**
     * Lists all Site entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('ACInst3Bundle:Site')->findAll();

        return $this->render('ACInst3Bundle:Site:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Site entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3Bundle:Site:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Site entity.
     *
     */
    public function newAction()
    {
        $entity = new Site();
        $form   = $this->createForm(new SiteType(), $entity);

        return $this->render('ACInst3Bundle:Site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Site entity.
     *
     */
    public function createAction()
    {
        $entity  = new Site();
        $request = $this->getRequest();
        $form    = $this->createForm(new SiteType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_site_show', array('id' => $entity->getId())));
            
        }

        return $this->render('ACInst3Bundle:Site:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Site entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site entity.');
        }

        $editForm = $this->createForm(new SiteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ACInst3Bundle:Site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Site entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('ACInst3Bundle:Site')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Site entity.');
        }

        $editForm   = $this->createForm(new SiteType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_site_edit', array('id' => $id)));
        }

        return $this->render('ACInst3Bundle:Site:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Site entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('ACInst3Bundle:Site')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Site entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_site'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
