<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tohouri\StoreBundle\Entity\Category;
use Tohouri\StoreBundle\Form\Type\CategoryType;

/**
 * Category controller.
 *
 * @Route("/TohouriStoreBundle_category")
 */
class CategoryController extends Controller
{
    /**
     * Lists all Category entities.
     *
     * @Route("/", name="TohouriStoreBundle_category")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $categories = $em->getRepository('TohouriStoreBundle:Category')->findAll();

        return array('categories' => $categories);
    }

    /**
     * Finds and displays a Category entity.
     *
     * @Route("/{id}/show", name="TohouriStoreBundle_category_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $category = $em->getRepository('TohouriStoreBundle:Category')->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'category'      => $category,
            'delete_form' => $deleteForm->createView(),        );
    }

	/**
     * Finds and displays a Category members.
     *
     * @Route("category/{id}/member", name="TohouriStoreBundle_category_member")
     * @Template()
     */
    public function categoryMemberAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $category = $em->getRepository('TohouriStoreBundle:Category')->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

		$products = $category->getProducts();

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'category'    => $category,
			'products'	  => $products,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Category entity.
     *
     * @Route("/new", name="TohouriStoreBundle_category_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $category = new Category();
        $form   = $this->createForm(new CategoryType(), $category);
		
		if($request->getMethod() == 'POST')
		{
			$form->bindRequest($request);
			if($form->isValid())
			{
				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($category);
				$em->flush();
				
				$this->get('session')->setFlash('notice', 'Your changes were saved!');
				return $this->redirect($this->generateUrl('TohouriStoreBundle_category_new'));
			}
		}	
		
		return $this->render('TohouriStoreBundle:Category:new.html.twig', array(
			'category' => $category,'form' => $form->createView(), ));
    }

    /**
     * Creates a new Category entity.
     *
     * @Route("/create", name="TohouriStoreBundle_category_create")
     * @Method("post")
     * @Template("TohouriStoreBundle:Category:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Category();
        $request = $this->getRequest();
        $form    = $this->createForm(new CategoryType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('TohouriStoreBundle_category_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Category entity.
     *
     * @Route("/{id}/edit", name="TohouriStoreBundle_category_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TohouriStoreBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm = $this->createForm(new CategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Category entity.
     *
     * @Route("/{id}/update", name="TohouriStoreBundle_category_update")
     * @Method("post")
     * @Template("TohouriStoreBundle:Category:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TohouriStoreBundle:Category')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Category entity.');
        }

        $editForm   = $this->createForm(new CategoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('TohouriStoreBundle_category_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Category entity.
     *
     * @Route("/{id}/delete", name="TohouriStoreBundle_category_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('TohouriStoreBundle:Category')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Category entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('TohouriStoreBundle_category'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
