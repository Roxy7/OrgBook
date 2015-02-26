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

	// La route fait appel à SdzBlogBundle:Blog:voir, on doit donc définir la méthode voirAction
	// On donne à cette méthode l'argument $id, pour correspondre au paramètre {id} de la route
	public function showAction($id)
	{
		// $id vaut 5 si l'on a appelé l'URL /blog/article/5

		// Ici, on récupèrera depuis la base de données l'article correspondant à l'id $id
		// Puis on passera l'article à la vue pour qu'elle puisse l'afficher

		return new Response("Affichage de l'article d'id : ".$id.".");
	}
	
	public function addAction()
	{
		return new Response("Ajout d'un livre");
	}
}