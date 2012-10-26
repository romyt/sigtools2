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

/* Creation: Thu Oct 25 10:50:49 GMT 2012
 * Class definition: Class that house the logic for building the Users Organisation Unit form
 * Class Path: /src/Tohouri/UsersBundle/Form/Type/SelectUserOrgUnitType.php
 */

namespace Tohouri\UsersBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\AbstractType;
use Tohouri\StoreBundle\Form\Type\OrganisationUnitType;

class SelectUserOrgUnitType extends AbstractType
{
	public function buildForm(FormBuilder $builder, array $options)

	{
		$builder->add('organistationunits', 'collection', array(
		    // each item in the array will be an "organisationunit" field
		    'type'   => 'organisationunit',
		    // these options are passed to each "organisationunit" type
		    'options'  => array(
		        'required'  => false,
		        'attr'      => array('class' => 'organisationunit')
		    ),
		));
	}

	public function getDefaultOptions(array $options)
	{
		return array(
			'data_class' => 'Tohouri\UsersBundle\Entity\User',
			);
	}

	public function getName()
	{
		return 'form_select_orgunit';
	}
}