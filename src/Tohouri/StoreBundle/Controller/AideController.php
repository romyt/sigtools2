<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * aide controller.
 *
 * @Route("/TohouriStoreBundle_aide")
 */
class AideController extends Controller
{
    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide")
     * @Template()
     */
    public function indexAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:index.html.twig',
      array('message' => $message));
    }



    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_premiereUtilisation")
     * @Template()
     */
    public function premiereUtilisationAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:premiereUtilisation.html.twig',
      array('message' => $message));
    }



    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_phaseAuthentification")
     * @Template()
     */
    public function phaseAuthentificationAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:phaseAuthentification.html.twig',
      array('message' => $message));
    }


   /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_creationCompte")
     * @Template()
     */
    public function creationCompteAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:creationCompte.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_pageAccueil")
     * @Template()
     */
    public function pageAccueilAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:pageAccueil.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_menu")
     * @Template()
     */
    public function menuAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:menu.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_manipulationOutil")
     * @Template()
     */
    public function manipulationOutilAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:manipulationOutil.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_nouvelleCategorie")
     * @Template()
     */
    public function nouvelleCategorieAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:nouvelleCategorie.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_nouvelOutil")
     * @Template()
     */
    public function nouvelOutilAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:nouvelOutil.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_nouvelEts")
     * @Template()
     */
    public function nouvelEtsAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:nouvelEts.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_commandeOutil")
     * @Template()
     */
    public function commandeOutilAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:commandeOutil.html.twig',
      array('message' => $message));
    }


    /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_receptionOutil")
     * @Template()
     */
    public function receptionOutilAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:receptionOutil.html.twig',
      array('message' => $message));
    }

  /**
     *
     * @Route("/", name="TohouriStoreBundle_aide_livraisonOutil")
     * @Template()
     */
    public function livraisonOutilAction()
    {
      $message = 'Cet espace est reservé à la documentation de la sur l\'application';

      return $this->container->get('templating')->renderResponse('TohouriStoreBundle:Aide:livraisonOutil.html.twig',
      array('message' => $message));
    }

}