<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tohouri\StoreBundle\Entity\OrganisationUnit;
use Tohouri\StoreBundle\Form\OrganisationUnitType;

/**
 * OrganisationUnit controller.
 *
 * @Route("/TohouriStoreBundle_orgunit")
 */
class OrganisationUnitController extends Controller
{
    /**
     * Lists all OrganisationUnit entities.
     *
     * @Route("/", name="TohouriStoreBundle_orgunit")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TohouriStoreBundle:OrganisationUnit')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a OrganisationUnit entity.
     *
     * @Route("/{id}/show", name="TohouriStoreBundle_orgunit_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TohouriStoreBundle:OrganisationUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrganisationUnit entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new OrganisationUnit entity.
     *
     * @Route("/new", name="TohouriStoreBundle_orgunit_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new OrganisationUnit();
        $form   = $this->createForm(new OrganisationUnitType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new OrganisationUnit entity.
     *
     * @Route("/create", name="TohouriStoreBundle_orgunit_create")
     * @Method("post")
     * @Template("TohouriStoreBundle:OrganisationUnit:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new OrganisationUnit();
        $request = $this->getRequest();
        $form    = $this->createForm(new OrganisationUnitType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('TohouriStoreBundle_orgunit_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing OrganisationUnit entity.
     *
     * @Route("/{id}/edit", name="TohouriStoreBundle_orgunit_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TohouriStoreBundle:OrganisationUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrganisationUnit entity.');
        }

        $editForm = $this->createForm(new OrganisationUnitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing OrganisationUnit entity.
     *
     * @Route("/{id}/update", name="TohouriStoreBundle_orgunit_update")
     * @Method("post")
     * @Template("TohouriStoreBundle:OrganisationUnit:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TohouriStoreBundle:OrganisationUnit')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrganisationUnit entity.');
        }

        $editForm   = $this->createForm(new OrganisationUnitType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('TohouriStoreBundle_orgunit_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a OrganisationUnit entity.
     *
     * @Route("/{id}/delete", name="TohouriStoreBundle_orgunit_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TohouriStoreBundle:OrganisationUnit')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OrganisationUnit entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('TohouriStoreBundle_orgunit'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
