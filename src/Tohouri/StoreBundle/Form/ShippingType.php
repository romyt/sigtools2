<?php

namespace Tohouri\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ShippingType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('status')
            ->add('shipped')
            ->add('cart')
            ->add('organisationunit')
        ;
    }

    public function getName()
    {
        return 'tohouri_storebundle_shippingtype';
    }
}
