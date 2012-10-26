<?php

namespace Tohouri\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tohouri\StoreBundle\Form\Type\SelectUserOrgUnitType;
use Tohouri\UsersBundle\Entity\User;

class UserController extends Controller
{
	.
	/**
	* @Route("/profile", name="user_orgunit_show")
	* @Template()
	*/
	
    public function selectOrgunitAction()
    {
		$em = $this->getDoctrine()->getEntityManager();
		$user = $this->container->get('security.context')->getToken()->getUser();
		$userOrganisationUnits = $user->getOrganisationunits();
	
		$form_select_orgunit = $this->get('form.factory')->create(new SelectOrgUnitType(), $user)
		
		return array('form' => $form_select_orgunit->createView(), 'userOrganisationUnits' => $userOrganisationUnits); // On passe à Twig l'objet form et notre objet desk
		
/*			
		// On créé l'objet form à partir du formBuilder (En passant en param l'objet Desk)
		$form_select_orgunit = $this->createFormBuilder($user)
			->add('organisationunits') // On ajoute le champ titre dans un input text
			->getForm(); // On récupère l'objet form
	
        return array(
            'userOrganisationUnits' => $userOrganisationunits,
            'form_select_orgunit'   => $form_select_orgunit->createView())
	
		
        $entity = $em->getRepository('TohouriUsersBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Organisation unit for this User.');
        }
		$request = $this->get('request'); // On récupère l'objet request via le service container

        $form = $this->createForm(new SelectOrgUnitType(), $entity); // On bind l'objet User à notre formulaire SelectOrgUnitType
		
		if ('POST' == $request->getMethod()) { // Si on a posté le formulaire
			$form->bindRequest($request); // On bind les données du form
			if ($form->isValid()) { // Si le formulaire est valide
					// Sauvegarder l'id de l'orgunit selectionné dans la session pour un usage plus tard
				$this->get('session')->setFlash('notice', $this->get('translator')->trans('Organisation Unit selected is '));
				// On redirige vers la page de modification du bureau
				return new RedirectResponse($this->generateUrl('desk_edit', array('deskId' => $desk->getId())));
			}

        return array(
            'entity'      => $entity,
            'form'   => $form->createView(),
        );
	

		

	}
	return array('form' => $form->createView(), 'desk' => $desk); // On passe à Twig l'objet form et notre objet desk
	
        return array('organisationunits' => $organisationunits);
*/
    }
}
