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

/* Creation: Tue Oct 18 20:00:13 GMT 2011
 * Class definition: Class that define the Cart entity
 * Class Path: /src/Tohouri/StoreBundle/Entity/Cart.php
 */

/**
 *  This file is a part of the symfony demo application
 *
 * (c) Noël GUILBERT <noelguilbert@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tohouri\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Tohouri\StoreBundle\Entity\Cart
 *
 * @ORM\Table()
 * @ORM\Entity()
 */

class Cart
{
	/**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

 	/**
   * Constructs the Cart instance
   *
   * @param Session $session 
   */ 
 	protected $session;
	
    /**
     * @var string $sessionId
     *
     * @ORM\Column(name="sessionid", type="string", length=255)
     */
    private $sessionId;

	/**
	 * @ORM\OneToMany(targetEntity="CartOrder", mappedBy="cart", cascade={"persist", "remove"})
     */
    private $cartOrders;

	
 	public function __construct($session)
	{
		$this->session = $session;
		$this->cartOrders = new \Doctrine\Common\Collections\ArrayCollection();
	}
	
	public function addItem($id, $quantity)
	{
    	$cart = $this->getSessionCart();		
		
	    if (!isset($cart[$id]))
	    {
	      $cart[$id] = $quantity;
	    }
	    else
	    {
	      $cart[$id] += $quantity;
	    }

	    $this->session->set('cart', $cart);
  	}

  	public function removeItem($id)
	{
	    $cart = $this->getSessionCart();

	    if (isset($cart[$id]) && --$cart[$id] == 0)
	    {
	      unset($cart[$id]);
	    }

	    $this->session->set('cart', $cart);
	}

	public function getSessionCart()
	{
		return $this->session->get('cart', array());
	 }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sessionId
     *
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * Get sessionId
     *
     * @return string 
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Add cartOrders
     *
     * @param Tohouri\StoreBundle\Entity\CartOrder $cartOrders
     */
    public function addCartOrder(\Tohouri\StoreBundle\Entity\CartOrder $cartOrders)
    {
        $this->cartOrders[] = $cartOrders;
    }

    /**
     * Get cartOrders
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCartOrders()
    {
        return $this->cartOrders;
    }
}