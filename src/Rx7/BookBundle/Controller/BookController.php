<?php

namespace Rx7\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
	public function indexAction($page)
	{
		if( $page < 1 )
		{
			// On déclenche une exception NotFoundHttpException
			// Cela va afficher la page d'erreur 404 (on pourra personnaliser cette page plus tard d'ailleurs)
			throw $this->createNotFoundException('Page inexistante (page = '.$page.')');
		}
		
		return $this->render('Rx7BookBundle:Book:index.html.twig');
	}

	public function showAction($id)
	{
		
		return $this->render('Rx7BookBundle:Book:show.html.twig', array(
				'id' => $id,
		));
	}
	
	public function addAction()
	{
		
		if( $this->get('request')->getMethod() == 'POST' )
    	{
	      	// Ici, on s'occupera de la création et de la gestion du formulaire
	    	$this->get('session')->getFlashBag()->add('info', 'Article bien enregistré');
	
	    	// Le « flashBag » est ce qui contient les messages flash dans la session
	    	// Il peut bien sûr contenir plusieurs messages :
	    	$this->get('session')->getFlashBag()->add('info', 'Oui oui, il est bien enregistré !');
	
	    	// Puis on redirige vers la page de visualisation de cet article
	    	return $this->redirect( $this->generateUrl('rx7book_show', array('id' => 5)) );
    	}
    	
    	return $this->render('Rx7BookBundle:Book:add.html.twig');
	}
	
	public function updateAction()
	{
		return $this->render('Rx7BookBundle:Book:update.html.twig');
	}
	
	public function deleteAction()
	{
		return $this->render('Rx7BookBundle:Book:delete.html.twig');
	}
}