<?php
/*
 * This file is part of SIGTOOLS2.
 * (c) 20011-2012 TOHOURI Romain-Rolland
 * http://www.tohouri.com
 * Tel: +225 03 44 49 44
 * Email: rtohouri@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* Creation: Thu Oct 13 00:32:12 GMT 2011
 * Class definition: Class that house the logic for building the Stock
 * Class Path: /src/Tohouri/StoreBundle/Controller/StockController.php
 */

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tohouri\StoreBundle\Entity\Stock;
use Tohouri\StoreBundle\Form\Type\StockType;


/**
 * Stock controller.
 *
 * @Route("/TohouriStoreBundle_stock")
 */
class StockController extends Controller
{
    /**
     * Lists all Stock entities.
     *
     * @Route("/stock", name="TohouriStoreBundle_stock")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $stocks = $em->getRepository('TohouriStoreBundle:Stock')->findAll();
		
        return array('stocks' => $stocks);
    }

    /**
     * Finds and displays a Stock entity.
     *
     * @Route("/{id}/show", name="TohouriStoreBundle_stock_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $stock = $em->getRepository('TohouriStoreBundle:Stock')->find($id);

        if (!$stock) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

	return $this->render('TohouriStoreBundle:Stock:show.html.twig', array('stock' => $stock));
    }

    /**
     * Displays a form to create a new Stock entity.
     *
     * @Route("/stock/new", name="TohouriStoreBundle_stock_new")
     * @Template()
     */
    public function newAction()
    {
       	$stock = new Stock();
        $form   = $this->createForm(new StockType(), $stock);

        return array(
            'stock' => $stock,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Stock entity.
     *
     * @Route("/create", name="TohouriStoreBundle_stock_create")
     * @Method("post")
     * @Template("TohouriStoreBundle:Stock:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $stock  = new Stock();
        $request = $this->getRequest();
        $form    = $this->createForm(new StockType(), $stock);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($stock);
            $em->flush();

			$this->get('session')->setFlash('notice', 'Your changes were saved!');
			
            return $this->redirect($this->generateUrl('TohouriStoreBundle_stock_show', array('id' => $stock->getId())));
            
        }

        return array(
            'entity' => $stock,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Stock entity.
     *
     * @Route("/{id}/edit", name="TohouriStoreBundle_stock_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $stock = $em->getRepository('TohouriStoreBundle:Stock')->find($id);

        if (!$stock) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

        $editForm = $this->createForm(new StockType(), $stock);


        return array(
            'stock'      => $stock,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
     * Edits an existing Stock entity.
     *
     * @Route("/{id}/update", name="TohouriStoreBundle_stock_update")
     * @Method("post")
     * @Template("TohouriStoreBundle:Stock:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $stock = $em->getRepository('TohouriStoreBundle:Stock')->find($id);

        if (!$stock) {
            throw $this->createNotFoundException('Unable to find Stock entity.');
        }

        $editForm   = $this->createForm(new StockType(), $stock);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($stock);
            $em->flush();

            return $this->redirect($this->generateUrl('TohouriStoreBundle_stock_edit', array('id' => $id)));
        }

        return array(
            'stock'      => $stock,
            'edit_form'   => $editForm->createView(),
        );
    }

	/**
     * Add to stock quantity of an existing Stock.
     *
     * @Route("/stock/addtoqty", name="TohouriStoreBundle_stock_addToQuantity")
     * @Method("post")
     * @Template("TohouriStoreBundle:Stock:add.html.twig")
     */
	public function addToQuantityAction(Request $request)
    {
		//setting default value of the form
		$stock = new Stock();
		$stock -> setQuantity(0);
		
		$form = $this-> createFormBuilder($stock)
			->add('quantity','integer')
			->add('product')
			->getForm();
		
		if('POST' === $request->getMethod())
		{
			$form->bindRequest($request);
			
			if($form->isValid())
			{
				// taking selected Product Id to retreave the related stock instance
				$qty = $stock->getQuantity();
				$product = $stock->getProduct();
				$em = $this->getDoctrine()->getEntityManager();
				$stock = $em->getRepository('TohouriStoreBundle:Stock')->findOneBy( array('product'=>$product->getId()) );
				
				if (!$stock) {
				        throw $this->createNotFoundException('No stock found for product '.$product);
				    }
				// updating the retreaved stock quantity property by adding the number post from the form to existing quantity
				$oldStock=$stock->getQuantity();
				
				$stock->setQuantity( $stock->getQuantity() + $qty );
				
				$em->persist($stock);
				$em->flush();
				$this->get('session')->setFlash('notice', 'Une nouvelle quantité ('.$qty.') à été ajoutée au stock précédent ('.$oldStock.') 
				le stock total est maintenant='.$stock->getQuantity().'');
				
				return $this->redirect($this->generateUrl('TohouriStoreBundle_stock_show', array( 'id' => $stock->getId() )));
			}
		}
			
		return array(
			'stock' => $stock,
			'form'	=> $form->createView()
		);
    }

}
