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
use FOS\UserBundle\Entity\UserManager;
use Tohouri\StoreBundle\Entity\Cart;
use Tohouri\StoreBundle\Entity\Product;
use Tohouri\StoreBundle\Entity\Stock;
use Tohouri\StoreBundle\Entity\User;
use Tohouri\StoreBundle\Entity\CartOrder;
use Tohouri\StoreBundle\Entity\OrganisationUnit;
use Tohouri\StoreBundle\Entity\Shipping;
use Tohouri\StoreBundle\Form\StockType;
use Tohouri\StoreBundle\Form\OrganisationUnitType;

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
	
	public function saveCart()
	{
		$em = $this->getDoctrine()->getEntityManager();
	}
	
	public function updateCart()
	{
		$em = $this->getDoctrine()->getEntityManager();
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
		$shipping = new Shipping();

		$form1 = $this->createFormBuilder($stock)
		            ->add('quantity', 'integer')
					->add('product')
		            ->getForm();

		$form2 = $this->createFormBuilder($shipping)
		            ->add('organisationunit')
		            ->getForm(); 
			
	    return $this->render('TohouriStoreBundle:Cart:index.html.twig', array(
	      'products' => $products,
	      'cart' => $cart->getSessionCart(),
		  'form1' => $form1->createView(),
		  'form2' => $form2->createView()
	    ));
	}
	
	public function addAction(Request $request)
    {
		//setting default value of the form
		$stock = new Stock();
		$shipping = new Shipping();
		$cartOrder = new CartOrder();
		$stock -> setQuantity(0);
		$user = $this->container->get('security.context')->getToken()->getUser();
		$em = $this->getDoctrine()->getEntityManager();
		$cart = new Cart($this->container->get('request')->getSession());
		$cartArray = $cart->getSessionCart();

		$form1 = $this-> createFormBuilder($stock)
			->add('quantity','integer')
			->add('product')
			->getForm();
			
		$form2 = $this->createFormBuilder($shipping)
		            ->add('organisationunit')
		            ->getForm();
		
		if('POST' === $request->getMethod())
		{			
			if(isset($form1)) 
			{
				$form1->bindRequest($request);

				if($form1->isValid())
				{
					// taking selected Product Id to retreave the related stock instance
					$qty = $stock->getQuantity();
					$product = $stock->getProduct();
					$stock = $em->getRepository('TohouriStoreBundle:Stock')->findOneBy( array('product'=>$product->getId()) );
					$products = $em->getRepository('TohouriStoreBundle:Product')->findAll();

					if (!$stock) 
					{
					 	throw $this->createNotFoundException('No stock found for product '.$product);
					 }

					 $cart->addItem($product->getId(), $qty);

					return $this->render('TohouriStoreBundle:Cart:index.html.twig', array(
				      'products' => $products,
				      'cart' => $cart->getSessionCart(),
					  'form1' => $form1->createView(),
					  'form2' => $form2->createView()
				    ));;
				}
			}
			
			if(isset($form2)) 
			{
				$form2->bindRequest($request);
				$user = $this->container->get('security.context')->getToken()->getUser();
				if($form2->isValid())
				{
					$isCartExist = $em->getRepository('TohouriStoreBundle:Cart')
									  ->findBySessionId($this->container->get('request')->getSession()->getId());
									
					// saving the cart if not already saved				
					if (count($isCartExist) === 0) 
					{
						$cart->setUser($user);								
						$cart->setSessionId($this->container->get('request')->getSession()->getId());
						$em->persist($cart);
						$em->flush();
				    }
				
					// Saving client orders related to the cart
					$sessionCart = $em->getRepository('TohouriStoreBundle:Cart')
									  ->findOneBySessionId($this->container->get('request')->getSession()->getId());
					if(!$sessionCart) throw $this->createNotFoundException('error! no cart found! '
												.$this->container->get('request')->getSession()->getId());

					if (count($sessionCart->getCartOrder()) < 1) // no cart product details stored yet
					{		
						foreach ($cartArray as $id => $quantity )
						{	
							$product = $em->getRepository('TohouriStoreBundle:Product')->find($id);
							$cartOrder->setProduct($product);
							$cartOrder->setQuantity($quantity);
							//remove the same quantity to product stock 
							$currentQuantity = $product->getStock()->getQuantity();																							
							$product->getStock()->setQuantity($currentQuantity - $quantity);
							$cartOrder->setCart($sessionCart);
													
							$sessionCart->addCartOrder($cartOrder);
							$em->persist($sessionCart);	
							$em->persist($product);	
							$em->flush();
							$em->clear();
						}	
						// persisting the shipping object
						$cartId = $sessionCart->getId();
						$cart = $em->getRepository('TohouriStoreBundle:Cart')->find($cartId);
						$orgunit = $em->getRepository('TohouriStoreBundle:OrganisationUnit')
									  ->find($shipping->getOrganisationUnit()->getId());
						$shipping->setStatus(FALSE);
						$shipping->setCart($cart);
						$shipping->setOrganisationUnit($orgunit);
						$em->persist($shipping);
						$em->flush();
						//Empty the cart
						$cart = new Cart($this->container->get('request')->getSession());
					    $cart->removeAllItem($id);
						
						$this->get('session')->setFlash('notice', 'Votre commande de '.count($cartArray)
						.' produit(s) à été envoyée à '.$orgunit);		
					}
					else // cart already have some products stored in CartOrder
					{						
						$cartOrderCollection = $sessionCart->getCartOrder();
						$cartId = $sessionCart->getId();
						$cartOrderItem = new CartOrder();
										
						// updating the cart products into cartOrder table
						foreach ($cartArray as $id => $quantity )
						{
							$currentCartOrder = $em->getRepository('TohouriStoreBundle:CartOrder')
											  ->findOneBy(array('product' => $id, 'cart' => $cartId));
							if(!$currentCartOrder)
							{
								// specific product not found! save this new item in cartOrder table
								$cart = $em->getRepository('TohouriStoreBundle:Cart')->find($cartId);
								$product = $em->getRepository('TohouriStoreBundle:Product')->find($id);																																				
								$cartOrderItem->setQuantity($quantity);
								//remove the same quantity to product stock
								$currentQuantity = $product->getStock()->getQuantity();																							
								$product->getStock()->setQuantity($currentQuantity - $quantity);
								
								$cartOrder->setCart($sessionCart);
										
								$cartOrderItem->setProduct($product);
								$cartOrderItem->setCart($cart);
								$cart->addCartOrder($cartOrderItem);
								$em->persist($cart);
								$em->persist($product);
								$em->flush();
								$em->clear();
							}
							else
							{
								$currentCartOrder = $em->getRepository('TohouriStoreBundle:CartOrder')
												  ->findOneBy(array('product' => $id, 'cart' => $cartId));
								$product = $em->getRepository('TohouriStoreBundle:Product')->find($id);	
								//update cartOrder item with new quantity
								$currentCartOrder->setQuantity($quantity);
								//remove the same quantity to product stock
								$currentQuantity = $product->getStock()->getQuantity();																							
								$product->getStock()->setQuantity($currentQuantity - $quantity);
								
								$cartOrder->setCart($sessionCart);
								$em->persist($currentCartOrder);
								$em->persist($product);
								$em->flush();
								$em->clear();
							}								
						}	
						// persisting the shipping object
						//if($form2->isValid()) throw $this->createNotFoundException('form2 is valid '.$shipping->getOrganisationUnit());
						$cart = $em->getRepository('TohouriStoreBundle:Cart')->find($cartId);
						$orgunit = $em->getRepository('TohouriStoreBundle:OrganisationUnit')
									  ->find($shipping->getOrganisationUnit()->getId());
						$shipping->setStatus(FALSE);
						$shipping->setCart($cart);
						$shipping->setOrganisationUnit($orgunit);
						$em->persist($shipping);
						$em->flush();
						//Empty the cart
						$cart = new Cart($this->container->get('request')->getSession());
					    $cart->removeAllItem($id);

						$this->get('session')->setFlash('notice', 'Votre commande de '.count($cartArray)
						.' produit(s) à été envoyée à '.$orgunit);
					}
					
				}
			}
		}
		
		$save = $request->query->get('save'); // retreiving GET variable
		if ($save === "yes") // saved order link is clicked
		{
			$cart = new Cart($this->container->get('request')->getSession());
			$cartArray = $cart ->getSessionCart();				
			$cartOrder = new CartOrder();
			$em = $this->getDoctrine()->getEntityManager();
			$user = $this->container->get('security.context')->getToken()->getUser();
			
			$isCartExist = $em->getRepository('TohouriStoreBundle:Cart')
							  ->findBySessionId($this->container->get('request')->getSession()->getId());
			if (!$isCartExist) 
			{
		        // throw $this->createNotFoundException('No cart found for session '.$this->container->get('request')->getSession()->getId());
				$cart->setUser($user);								
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
			// --**A faire**--: comparer le count de la collection cartOrder lié a la session avec $cartArray 
			// avant de confirmer la sauvegarde correcte 
			$this->get('session')->setFlash('notice', 'Votre commande de '.count($cartArray)
			.' produit(s) à été envoyée! User id='.$user->getId());
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
	  public function removeAllAction()
	  {
			$em = $this->getDoctrine()->getEntityManager();
			$cart = new Cart($this->container->get('request')->getSession());
			$cartArray = $cart->getSessionCart();
			foreach ($cartArray as $id => $quantity )
			{
		    	$cart->removeAllItem($id);
			}

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