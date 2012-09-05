<?php

namespace Tohouri\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('TohouriUploadBundle:Default:index.html.twig', array('name' => $name));
    }

	public function uploadAction()
	{


	    if ($form->isValid()) {
	        $someNewFilename = "export_".time().".xml";

	        $form['attachment']->getData()->move($dir, $someNewFilename);

	        
	    }
	}
}
