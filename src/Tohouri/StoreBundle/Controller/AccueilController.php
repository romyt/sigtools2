<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * accueil controller.
 *
 * @Route("/TohouriStoreBundle_accueil")
 */
class AccueilController extends Controller
{
    /**
     *
     * @Route("/", name="TohouriStoreBundle_accueil")
     * @Template()
     */
    public function indexAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Accueil:index.html.twig',
      array('message' => $message));
    }

}
