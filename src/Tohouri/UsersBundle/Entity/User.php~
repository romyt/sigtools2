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

/* Creation: Fri Oct 28 13:15:26 GMT 2011
 * Class definition: Class that define the User entity properties
 * Class Path: /src/Tohouri/StoreBundle/Entity/User.php
 */

namespace Tohouri\UsersBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Tohouri\StoreBundle\Entity\OrganisationUnit;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tohouri\UsersBundle\Entity\User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

   /**
     * @ORM\Column(type="string", length="255")
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $name;	

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=255)
	 *
	 * @Assert\NotBlank(message="Please enter your firstname.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="255", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $firstname;	

	/**
	 *
     * @ORM\Column(name="country", type="string", length=50)
	 *
	 */
	protected $country;

	/**
	 *
     * @ORM\Column(name="city", type="string", length=50)
	 *
	 */
	protected $city;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $address;

    /**
     * @var string $tel
     *
     * @ORM\Column(name="tel", type="string", length=17)
     */
    protected $tel;

    /**
     * @ORM\ManyToMany(targetEntity="Tohouri\StoreBundle\Entity\OrganisationUnit")
     * @ORM\JoinTable(name="user_organisationunits",	
	 * 		joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
	 *      inverseJoinColumns={@ORM\JoinColumn(name="organisationunit_id", referencedColumnName="id", unique=true)})
     */
	private $organisationunits;
		
	
	public function __toString()
	{
		return $this->getName();
	}
	
    public function __construct()
    {
        parent::__construct();
		$this->organisationunits = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
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
     * Set tel
     *
     * @param string $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }


    /**
     * Add organisationunits
     *
     * @param Tohouri\UsersBundle\Entity\OrganisationUnit $organisationunits
     */
    public function addOrganisationUnit(\Tohouri\UsersBundle\Entity\OrganisationUnit $organisationunits)
    {
        $this->organisationunits[] = $organisationunits;
    }

    /**
     * Get organisationunits
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrganisationunits()
    {
        return $this->organisationunits;
    }
}