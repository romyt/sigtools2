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

/* Creation: Thu Oct 13 00:36:02 GMT 2011
 * Class definition: Class that house the logic for building the Stock form
 * Class Path: /src/Tohouri/StoreBundle/Form/StockType.php
 */

namespace Tohouri\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StockType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('product')
        ;
    }

    public function getName()
    {
        return 'tohouri_storebundle_stocktype';
    }
}
