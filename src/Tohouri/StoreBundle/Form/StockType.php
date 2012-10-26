<?php

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
            ->add('organisationunit')
        ;
    }

    public function getName()
    {
        return 'tohouri_storebundle_stocktype';
    }
}
