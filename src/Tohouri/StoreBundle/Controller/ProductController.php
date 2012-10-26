<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tohouri\StoreBundle\Entity\Product;
use Tohouri\StoreBundle\Form\Type\ProductType;

/**
 * Product controller.
 *
 * @Route("/TohouriStoreBundle_product")
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     * @Route("/", name="TohouriStoreBundle_product")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $products = $em->getRepository('TohouriStoreBundle:Product')->findAll();

        return array('products' => $products);
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/{id}/show", name="TohouriStoreBundle_product_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $product = $em->getRepository('TohouriStoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'product'      => $product,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Product entity.
     *
     * @Route("/new", name="TohouriStoreBundle_product_new")
     * @Template()
     */
    public function newAction()
    {
        $product = new Product();
        $form   = $this->createForm(new ProductType(), $product);

        return array(
            'product' => $product,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Product entity.
     *
     * @Route("/create", name="TohouriStoreBundle_product_create")
     * @Method("post")
     * @Template("TohouriStoreBundle:Product:new.html.twig")
     */
    public function createAction()
    {
        $product  = new Product();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProductType(), $product);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($product);
            $em->flush();

			$this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('TohouriStoreBundle_product_show', array('id' => $product->getId())));
            
        }

        return array(
            'product' => $product,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("product/{id}/edit", name="TohouriStoreBundle_product_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $product = $em->getRepository('TohouriStoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm = $this->createForm(new ProductType(), $product);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'product'      => $product,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Product entity.
     *
     * @Route("/{id}/update", name="TohouriStoreBundle_product_update")
     * @Method("post")
     * @Template("TohouriStoreBundle:Product:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $product = $em->getRepository('TohouriStoreBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm   = $this->createForm(new ProductType(), $product);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($product);
            $em->flush();

			$this->get('session')->setFlash('notice', 'Your changes were saved!');
            return $this->redirect($this->generateUrl('TohouriStoreBundle_product_edit', array('id' => $id)));
        }

        return array(
            'product'      => $product,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}/delete", name="TohouriStoreBundle_product_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $product = $em->getRepository('TohouriStoreBundle:Product')->find($id);

            if (!$product) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($product);
            $em->flush();
			$this->get('session')->setFlash('notice', 'The selected product with id='.$id.' were correctly deleted!');
        }

        return $this->redirect($this->generateUrl('TohouriStoreBundle_product'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
