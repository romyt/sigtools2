<?php

namespace Tohouri\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tohouri\StoreBundle\Entity\Shipping
 *
 * @ORM\Table(name="shipping")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Shipping
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
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

	/**
	 *
     * @ORM\Column(name="shipped", type="datetime", nullable=true)
	 *
	 */
	protected $shipped;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Cart", inversedBy="shipping")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    private $cart;

	/**
	 * @ORM\ManyToOne(targetEntity="OrganisationUnit", inversedBy="shipping")
     * @ORM\JoinColumn(name="organisationUnit_id", referencedColumnName="id")
     */
    private $organisationunit;

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
	 *
     * @ORM\Column(name="created", type="datetime")
	 *
	 */
	protected $created;

    /**
     * Set status
     *
     * @param boolean $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set organisationunit
     *
     * @param Tohouri\StoreBundle\Entity\OrganisationUnit $organisationunit
     */
    public function setOrganisationunit(\Tohouri\StoreBundle\Entity\OrganisationUnit $organisationunit)
    {
        $this->organisationunit = $organisationunit;
    }

    /**
     * Get organisationunit
     *
     * @return Tohouri\StoreBundle\Entity\OrganisationUnit 
     */
    public function getOrganisationunit()
    {
        return $this->organisationunit;
    }

	/**
	 * @ORM\preUpdate
	 */
	public function setShippedValue()
	{
	    $this->shipped = new \DateTime();
	}

    /**
     * Set shipped
     *
     * @param datetime $shipped
     */
    public function setShipped($shipped)
    {
        $this->shipped = $shipped;
    }

    /**
     * Get shipped
     *
     * @return datetime 
     */
    public function getShipped()
    {
        return $this->shipped;
    }
	/**
	 * @ORM\prePersist
	 */
	public function setCreatedValue()
	{
	    $this->created = new \DateTime();
	}

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
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