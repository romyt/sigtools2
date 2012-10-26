<?php

namespace Tohouri\UsersBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
		$builder->add('name');
		$builder->add('firstname');
		$builder->add('country', 'country');
		$builder->add('city');
		$builder->add('address');
		$builder->add('tel');
        $builder->add('organisationunits');

    }

    public function getName()
    {
        return 'tohouri_user_registration';
    }
}