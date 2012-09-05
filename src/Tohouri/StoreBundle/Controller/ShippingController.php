<?php

namespace Tohouri\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tohouri\StoreBundle\Entity\Shipping;

/**
 * Shipping controller.
 *
 * @Route("/TohouriStoreBundle_shipping")
 */
class ShippingController extends Controller
{
    /**
     * Lists all Shipping entities.
     *
     * @Route("/", name="TohouriStoreBundle_shipping")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('TohouriStoreBundle:Shipping')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Shipping entity.
     *
     * @Route("/{id}/show", name="TohouriStoreBundle_shipping_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('TohouriStoreBundle:Shipping')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shipping entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }

}
