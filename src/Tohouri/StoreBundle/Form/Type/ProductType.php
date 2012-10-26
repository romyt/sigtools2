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

namespace Tohouri\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProductType extends AbstractType
{
	public function getName()
	{
	    return 'product';
	}
	

	public function buildForm(FormBuilder $builder, array $options)
	{
		$builder->add('name', 'text');
		$builder->add('code', 'text');
		$builder->add('description', 'textarea');
		$builder->add('price', 'money', array('currency'=>'USD'));
		$builder->add('category', 'entity', array(
		    'class' => 'TohouriStoreBundle:Category', ));
	}
	
	public function getDefaultOptions(array $options)
	{
		return array('data_class' => 'Tohouri\StoreBundle\Entity\Product',);
	}

}
?>