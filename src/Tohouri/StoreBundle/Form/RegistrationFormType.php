<?php

namespace Tohouri\StoreBundle\Form;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\Form\CountryField;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('name');
		$builder->add('firstname');
		$builder->add('country','country');
		$builder->add('region');
		$builder->add('city');
		$builder->add('address');
		$builder->add('tel');
    }

    public function getName()
    {
        return 'fos_user_register';
    }
}