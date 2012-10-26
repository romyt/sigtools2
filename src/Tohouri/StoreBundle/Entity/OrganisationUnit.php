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

/* Creation: Mon Oct 31 12:45:25 GMT 2011
 * Class definition: Class OrganisationUnit
 * Class Path: /src/Tohouri/StoreBundle/Entity/OrganisationUnit.php
 */
namespace Tohouri\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Tohouri\UsersBundle\Entity\User;

/**
 * Tohouri\StoreBundle\Entity\OrganisationUnit
 *
 * @ORM\Table(name="organisation_unit")
 * @ORM\Entity(repositoryClass="Tohouri\StoreBundle\Entity\OrganisationUnitRepository")
 */
class OrganisationUnit
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
     * @ORM\Column(name="address", type="text")
     */
    private $address;
    
	/**
     * @ORM\OneToMany(targetEntity="Shipping", mappedBy="organisationUnit", cascade={"remove"})
     */
    private $shipping;

    /**
     * @ORM\OneToMany(targetEntity="OrganisationUnit", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="OrganisationUnit", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;

    /**
     * @ORM\ManyToMany(targetEntity="Tohouri\UsersBundle\Entity\User")
     */
    private $users;


	public function __toString()
	{
		return $this->getName();
	}
	
    public function __construct()
    {
       // $this->user = new \Doctrine\Common\Collections\ArrayCollection();
		$this->children = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set address
     *
     * @param text $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return text 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return integer 
     */
    public function getParent()
    {
        return $this->parent;
    }

  
    /**
     * Add shipping
     *
     * @param Tohouri\StoreBundle\Entity\Shipping $shipping
     */
    public function addShipping(\Tohouri\StoreBundle\Entity\Shipping $shipping)
    {
        $this->shipping[] = $shipping;
    }

    /**
     * Get shipping
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Add children
     *
     * @param Tohouri\StoreBundle\Entity\OrganisationUnit $children
     */
    public function addOrganisationUnit(\Tohouri\StoreBundle\Entity\OrganisationUnit $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

 

    /**
     * Add users
     *
     * @param Tohouri\UsersBundle\Entity\User $users
     */
    public function addUser(\Tohouri\UsersBundle\Entity\User $users)
    {
        $this->users[] = $users;
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}