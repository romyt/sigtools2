<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * Choisirlangue controller.
 *
 * @Route("/TohouriStoreBundle_choisir_langue")
 */
class ChoisirlangueController extends Controller
{
    /**
     *
     * @Route("/", name="TohouriStoreBundle_choisir_langue")
     * @Template()
     */
public function choisirLangueAction($langue = null)
{
    if($langue != null)
    {
        // On enregistre la langue en session
        $this->container->get('session')->setLocale($langue);
    }
// on tente de rediriger vers la page d'origine
    $url = $this->container->get('request')->headers->get('referer');
    if(empty($url)) {
        $url = $this->container->get('router')->generate('TohouriStoreBundle_product_index');
    }
    return $this->redirect($this->generateUrl('TohouriStoreBundle_homepage')); 
}
}
