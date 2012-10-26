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

/* Creation: Thu Oct 25 16:35:41 GMT 2012
 * Class definition: Class that house the logic for building the User Profile form
 * Class Path: /src/Tohouri/UsersBundle/Form/Type/ProfileFormType.php
 */
namespace Tohouri\UsersBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProfileFormType extends AbstractType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $child = $builder->create('user', 'form', array('data_class' => $this->class));
        $this->buildUserForm($child, $options);

        $builder
            ->add($child)
            ->add('current', 'password')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'FOS\UserBundle\Form\Model\CheckPassword');
    }

    public function getName()
    {
        return 'tohouri_user_profile';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilder $builder
     * @param array $options
     */
    protected function buildUserForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email', 'email')
			->add('name')
			->add('firstname')
			->add('organisationunits')
        ;
    }
}
