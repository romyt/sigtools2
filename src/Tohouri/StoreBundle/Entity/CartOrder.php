<?php

namespace Tohouri\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tohouri\StoreBundle\Entity\CartOrder
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CartOrder
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
     * @var integer $quantity
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

	/**
     *  @ORM\ManyToOne(targetEntity="Product", inversedBy="cartOrders")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;
	
	/**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="cartOrders")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    protected $cart;

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
     * Set quantity
     *
     * @param integer $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }


    /**
     * Set product
     *
     * @param Tohouri\StoreBundle\Entity\Product $product
     */
    public function setProduct(\Tohouri\StoreBundle\Entity\Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return Tohouri\StoreBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set cart
     *
     * @param Tohouri\StoreBundle\Entity\Cart $cart
     */
    public function setCart(\Tohouri\StoreBundle\Entity\Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get cart
     *
     * @return Tohouri\StoreBundle\Entity\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }
}