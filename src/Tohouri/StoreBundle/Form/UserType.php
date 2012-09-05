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

/* Creation: Mon Oct 10 00:45:45 GMT 2011
 * Class definition: Class that will house the logic for building the product form
 * /src/Tohouri/StoreBundle/Form/ProductType.php
 */

namespace Tohouri\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;


class UserType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name');
		$builder->add('firstname');
		$builder->add('country', 'nationality');
		$builder->add('region');
		$builder->add('city');
		$builder->add('address');
		$builder->add('tel');
    }

    public function getName()
    {
        return 'fos_user_register';
    }

	public function getDefaultOptions(array $options)
	{
		return array('data_class' => 'Tohouri\StoreBundle\Entity\User',);
	}
}
?>