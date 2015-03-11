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
		$links = array( array('route' => 'fos_user_profile_edit', 'display' => 'Editer le profil'),
						array('route' => 'fos_user_change_password', 'display' => 'Changer de mdp'),
						array('route' => 'fos_user_security_logout', 'display' => 'Se deconecter')
		);
		
		return $this->render('Rx7UserBundle::navLink.html.twig', array(
				'link_list' => $links
		));
	}
	
}