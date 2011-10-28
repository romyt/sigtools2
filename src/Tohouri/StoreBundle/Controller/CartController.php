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

/* Creation: Tue Oct 18 21:20:55 GMT 2011
 * Class definition: Class that house the logic for building the Cart 
 * Class Path: /src/Tohouri/StoreBundle/Controller/CartController.php
 */

namespace Tohouri\StoreBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Tohouri\StoreBundle\Entity\Cart;
use Tohouri\StoreBundle\Entity\Product;
use Tohouri\StoreBundle\Entity\Stock;
use Tohouri\StoreBundle\Entity\CartOrder;
use Tohouri\StoreBundle\Form\StockType;

/**
 * Cart controller.
 *
 * @Route("/TohouriStoreBundle_cart")
 */
class CartController extends Controller
{

	public function findAllProduct()
	{
		$em = $this->getDoctrine()->getEntityManager();

        $products = $em->getRepository('TohouriStoreBundle:Product')->findAll();

        return array('products' => $products);
	}
	
	/**
     * Lists all Product entities.
     *
     * @Route("/cart", name="TohouriStoreBundle_cart")
     * @Template()
     */
	  public function indexAction()
	  {
		$em = $this->getDoctrine()->getEntityManager();

        $products = $em->getRepository('TohouriStoreBundle:Product')->findAll();

	    $cart = new Cart($this->container->get('request')->getSession());
	
		$stock = new Stock();
		
		$form = $this->createFormBuilder($stock)
		            ->add('quantity', 'integer')
					->add('product')
		            ->getForm();
			
	    return $this->render('TohouriStoreBundle:Cart:index.html.twig', array(
	      'products' => $products,
	      'cart' => $cart->getSessionCart(),
		  'form' => $form->createView()
	    ));
	  }
	
	public function addAction(Request $request)
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
				$products = $em->getRepository('TohouriStoreBundle:Product')->findAll();

				if (!$stock) {
				        throw $this->createNotFoundException('No stock found for product '.$product);
				    }
				
				 $cart = new Cart($this->container->get('request')->getSession());
				 $cart->addItem($product->getId(), $qty);
				
				return $this->render('TohouriStoreBundle:Cart:index.html.twig', array(
			      'products' => $products,
			      'cart' => $cart->getSessionCart(),
				  'form' => $form->createView()
			    ));;
			}
		}
		
		$save = $request->query->get('save'); // retreiving GET variable
		if ($save === "yes") // saved order link is clicked
		{
			$cart = new Cart($this->container->get('request')->getSession());
			$cartArray = $cart ->getSessionCart();				
			$cartOrder = new CartOrder();
			$em = $this->getDoctrine()->getEntityManager();
			$isCartExist = $em->getRepository('TohouriStoreBundle:Cart')
							  ->findBySessionId($this->container->get('request')->getSession()->getId());
							
			if (count($isCartExist) === 0)
			{
				$this->get('session')->setFlash('notice', 'Vous commencez une nouvelle session avec pour ID: '.count($isCartExist).'');
				$cart->setSessionId($this->container->get('request')->getSession()->getId());
				$em->persist($cart);
				$em->flush();
			}


				
			// Saving client order
		foreach ($cartArray as $id => $quantity )
			{	
				$em = $this->getDoctrine()->getEntityManager();	
				$product = $em->getRepository('TohouriStoreBundle:Product')->find($id);
				$clientCart = $em->getRepository('TohouriStoreBundle:Cart')
								  ->findOneBySessionId($this->container->get('request')->getSession()->getId());
								
				$cartOrder->setProduct($product);
				$cartOrder->setQuantity($quantity);
				$cartOrder->setCart($clientCart);
				$clientCart->addCartOrder($cartOrder);
				$em->persist($clientCart);		
				$em->flush();
				$em->clear();
			} 
			$this->get('session')->setFlash('notice', 'Votre commande de '.count($cartArray).' produit(s) à été envoyée!');	
		}
			return $this->redirect($this->generateUrl('TohouriStoreBundle_cart'));			
	}

	  public function removeAction($id)
	  {
			$em = $this->getDoctrine()->getEntityManager();

	        $products = $em->getRepository('TohouriStoreBundle:Product')->findAll();
		
		    $cart = new Cart($this->container->get('request')->getSession());
		    $cart->removeItem($id);

		    if ($this->container->get('request')->isXmlHttpRequest())
		    {
		      return $this->render('TohouriStoreBundle_cart_remove:Cart:cart.html.twig', array(
		        'products' => $products,
		        'cart' => $cart->getCart()
		      ));
		    }
		    else
		    {
		      return $this->redirect($this->generateUrl('TohouriStoreBundle_cart'));
		    }
	  }	
}