<?php

namespace Tohouri\StoreBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class OrganisationUnitType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('parent')
            ->add('children')
        ;
    }

    public function getName()
    {
        return 'tohouri_storebundle_organisationunittype';
    }
}
