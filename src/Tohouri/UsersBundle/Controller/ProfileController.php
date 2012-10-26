<?php
/*
 * This file is part of SIGTOOLS2.
 * (c) 20011-2012 TOHOURI Romain-Rolland
 * http://www.tohouri.com
 * Tel: +225 03 44 49 44
 * Email: rtohouri@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* Creation: Thu Oct 25 09:57:11 GMT 2012
 * Class definition: Class that house the logic for building the product form
 * Class Path: /src/Tohouri/UsersBundle/ProfileController.php
 */

namespace Tohouri\UsersBundle\Controller;

use Symfony\Component\Form\FormBuilder;
use Tohouri\UsersBundle\Entity\User;
use Tohouri\UsersBundle\Form\Type\ProfileFormType;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as BaseController;

/**
 * Controller managing the user profile
 *
 */
class ProfileController extends BaseController
{
	/**
	* Shortcut to return the Doctrine Registry service.
	*
	* @return Registry
	*
	* @throws \LogicException If DoctrineBundle is not available
	*/
	 public function getDoctrine()
	 {
	    if (!$this->container->has('doctrine')) {
	            throw new \LogicException('The DoctrineBundle is not registered in your application.');
	 }

	    return $this->container->get('doctrine');
	 }
	
    /**
     * Show the user
     */
    public function showAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

		$userOrganisationUnits = $user->getOrganisationunits();

		//$form_select_orgunit = $this->container->get('form.factory')->create(new SelectUserOrgUnitType(), $userOrganisationUnits);

        return $this->container->get('templating')->renderResponse('TohouriUsersBundle:Profile:show.html.'.$this->container->getParameter('fos_user.template.engine'), array('user' => $user));
    }

    /**
     * Edit the user
     */
    public function editAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $form = $this->container->get('fos_user.profile.form');

		//$form = $this->createForm(new ProfileFormType(), $user);
		
        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);
        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');

            return new RedirectResponse($this->container->get('router')->generate('fos_user_profile_show'));
        }

        return $this->container->get('templating')->renderResponse(
            'TohouriUsersBundle:Profile:edit.html.'.$this->container->getParameter('fos_user.template.engine'),
			array(
				'form' => $form->createView(), 
				'theme' => $this->container->getParameter('fos_user.template.theme')
				)
        );
    }

    protected function setFlash($action, $value)
    {
        $this->container->get('session')->setFlash($action, $value);
    }
}
