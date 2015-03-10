<?php

namespace Rx7\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookBundle\Entity\Author;
use Rx7\BookBundle\Form\AuthorType;
use JMS\SecurityExtraBundle\Annotation\Secure;


class AuthorController extends Controller
{
	public function addAction()
	{
			
		$author = new Author();
	
		$form = $this->createForm(new AuthorType, $author);
		$request = $this->get('request');
	
	
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
	
			if ($form->isValid()) {
					
				$em = $this->getDoctrine()->getManager();
				$em->persist($author);
				$em->flush();
				 
				 
				$this->get('session')->getFlashBag()->add('info', 'Autheur bien ajouté');
				return $this->redirect($this->generateUrl('rx7book_index'));
			}
		}
		 
		return $this->render('Rx7BookBundle:Author:addAuthor.html.twig', array('form' => $form->createView()));
	}
}