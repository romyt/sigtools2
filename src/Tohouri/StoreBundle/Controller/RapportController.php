<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Rapport controller.
 *
 * @Route("/TohouriStoreBundle_rapport")
 */
class RapportController extends Controller
{
    /**
     *
     * @Route("/", name="TohouriStoreBundle_rapport")
     * @Template()
     */
    public function indexAction()
    {
      $message = 'le rapport des opérations ici!';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Rapport:index.html.twig',
      array('message' => $message));
    }

}
