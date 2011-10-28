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

/* Creation: Mon Oct 10 00:47:28 GMT 2011
 * Class definition: Class that house the product Entity definition
 * /src/Tohouri/StoreBundle/Entity/Product.php
 */

namespace Tohouri\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tohouri\StoreBundle\Entity\Product
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Product
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $code
     *
     * @ORM\Column(name="code", type="string", length=10)
     */
    private $code;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float $price
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

	/**
	* @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
	*/
	protected $category;

	/**
	* @ORM\OneToOne(targetEntity="Stock", mappedBy="product")
	*/
	private $stock;

	/**
	 * @ORM\OneToMany(targetEntity="CartOrder", mappedBy="product", cascade={"persist", "remove"})
     */
    private $cartOrders;



    public function __construct() {
        $this->cartOrders = new \Doctrine\Common\Collections\ArrayCollection();
    }

	public function __toString()
	{
		return $this->getName();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set category
     *
     * @param Tohouri\StoreBundle\Entity\Category $category
     */
    public function setCategory(\Tohouri\StoreBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Tohouri\StoreBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set stock
     *
     * @param Tohouri\StoreBundle\Entity\Stock $stock
     */
    public function setStock(\Tohouri\StoreBundle\Entity\Stock $stock)
    {
        $this->stock = $stock;
    }

    /**
     * Get stock
     *
     * @return Tohouri\StoreBundle\Entity\Stock 
     */
    public function getStock()
    {
        return $this->stock;
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