<?php

namespace Rx7\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
	public function indexAction()
	{
		return new Response("Page d'accueil des livres");
	}

	// La route fait appel � SdzBlogBundle:Blog:voir, on doit donc d�finir la m�thode voirAction
	// On donne � cette m�thode l'argument $id, pour correspondre au param�tre {id} de la route
	public function showAction($id)
	{
		// $id vaut 5 si l'on a appel� l'URL /blog/article/5

		// Ici, on r�cup�rera depuis la base de donn�es l'article correspondant � l'id $id
		// Puis on passera l'article � la vue pour qu'elle puisse l'afficher

		return new Response("Affichage de l'article d'id : ".$id.".");
	}
	
	public function addAction()
	{
		return new Response("Ajout d'un livre");
	}
}