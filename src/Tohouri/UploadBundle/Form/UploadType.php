<?php

namespace Tohouri\UploadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
		$builder->add('attachment', 'file');
    }
}
