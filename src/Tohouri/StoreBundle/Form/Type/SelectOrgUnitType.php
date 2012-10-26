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

/* Creation: Tue Sep 11 16:43:54 GMT 2012
 * Class definition: Class that house the logic for building the product form
 * Class Path: /src/Tohouri/StoreBundle/SelectOrgUnitType.php
 */

namespace Tohouri\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SelectOrgUnitType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('organisationunits', 'choice')
        ;
    }

	public function getDefaultOptions(array $options)
	{
		return array( 'data_class' => 'Tohouri\UsersBundle\Entity\User', );
	}

    public function getName()
    {
        return 'tohouri_storebundle_selectorgunit';
    }
}
