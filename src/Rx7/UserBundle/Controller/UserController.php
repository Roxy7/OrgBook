<?php

namespace Rx7\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\UserBundle\Entity\User;


use JMS\SecurityExtraBundle\Annotation\Secure;


class UserController extends Controller
{
	
	public function navLinkAction ()
	{
		
		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$links = array( array('route' => 'fos_user_profile_edit', 'display' => 'Editer le profil'),
							array('route' => 'fos_user_change_password', 'display' => 'Changer de mdp'),
							array('route' => 'fos_user_security_logout', 'display' => 'Se deconecter')
			);
			

		} else {
				$links = array( array('route' => 'fos_user_security_login', 'display' => 'Se connecter')
				);
		}
		return $this->render('Rx7UserBundle::navLink.html.twig', array(
				'link_list' => $links
		));
	}
	
}