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

/* Creation: Wed Oct 12 19:56:21 GMT 2011
 * Class definition: Stock entity class aimed to managed product stock
 * Class Path: /src/Tohouri/StoreBundle/Entity/Stock.php
 */

namespace Tohouri\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tohouri\StoreBundle\Entity\Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="Tohouri\StoreBundle\Entity\StockRepository")
 */
class Stock
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
	* @ORM\ManyToOne(targetEntity="Product", inversedBy="stocks")
	* @ORM\JoinColumn(name="product_id", referencedColumnName="id")
	*/
	private $product;
	
	/**
	* @ORM\ManyToOne(targetEntity="OrganisationUnit", inversedBy="stocks")
	* @ORM\JoinColumn(name="organisationunit_id", referencedColumnName="id")
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
     * add to existing quantity
     *
     * @return integer 
     */
    public function addQuantity($quantity)
    {
        return $this->quantity + $quantity;
    }

  /**
     * remove to existing quantity
     *
     * @return integer 
     */
    public function removeQuantity($quantity)
    {
        return $this->quantity - $quantity;
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
}