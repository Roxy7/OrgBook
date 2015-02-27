<?php

namespace Rx7\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookBundle\Entity\Book;
use Rx7\BookBundle\Entity\Image;
use Rx7\BookBundle\Entity\Author;

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
		

		$books = array(
				array(
						'titre'   => 'Mon weekend a Phi Phi Island !',
						'id'      => 1,
						'auteur'  => 'winzou',
						'contenu' => 'Ce weekend était trop bien. Blabla…',
						'date'    => new \Datetime()),
				array(
						'titre'   => 'Repetition du National Day de Singapour',
						'id'      => 2,
						'auteur' => 'winzou',
						'contenu' => 'Bientôt prêt pour le jour J. Blabla…',
						'date'    => new \Datetime()),
				array(
						'titre'   => 'Chiffre d\'affaire en hausse',
						'id'      => 3,
						'auteur' => 'M@teo21',
						'contenu' => '+500% sur 1 an, fabuleux. Blabla…',
						'date'    => new \Datetime())
		);
		
		return $this->render('Rx7BookBundle:Book:index.html.twig', array(
				'books' => $books
		));
	}

	public function showAction($id)
	{
		
		$repository = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('Rx7BookBundle:Book');
		$book = $repository->find($id);
		
		if($book === null)
		{
			throw $this->createNotFoundException('Book[id='.$id.'] inexistant.');
		}
		
		return $this->render('Rx7BookBundle:Book:show.html.twig', array(
				'book' => $book,
		));
	}
	
	public function addAction()
	{
		
		$book = new Book();
		$book->setTitle('La Huitième Couleur');
		$book->setText('super livre !');
		
		$image = new Image();
		$image->setUrl('http://kemar.blogs.3dvf.com/files/2010/12/8c-625x1024.jpg');
		$image->setAlt('Couverture de "La Huitième Couleur"');
		
		$author = new Author();
		$author->setFirstName('Terry');
		$author->setLastName('Pratchet');
		
		$book->setCover($image);
		$book->setAuthor($author);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($book);
		$em->persist($author);
		$em->flush();
		
		
		if( $this->get('request')->getMethod() == 'POST' )
    	{
	    	$this->get('session')->getFlashBag()->add('info', 'Livre bien enregistré');
	    	return $this->redirect( $this->generateUrl('rx7book_show', array('id' => $book->getId())) );
    	}
    	
		
		// Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
		return $this->render('Rx7BookBundle:Book:add.html.twig');
	}
	
	public function updateAction($id)
	{
		$book = array(
				'id'      => 1,
				'titre'   => 'Mon weekend a Phi Phi Island !',
				'auteur'  => 'winzou',
				'contenu' => 'Ce weekend était trop bien. Blabla…',
				'date'    => new \Datetime()
		);
		
		// Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
		return $this->render('Rx7BookBundle:Book:update.html.twig', array(
				'book' => $book
		));
	}
	
	public function deleteAction()
	{
		$this->get('session')->getFlashBag()->add('info', 'Livre bien supprimé');
		return $this->redirect( $this->generateUrl('rx7book_index') );
	}
	
	public function navAction($nombre)
	{
		// On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
		$liste = array(
				array('id' => 2, 'titre' => 'Livre 2'),
				array('id' => 5, 'titre' => 'Livre 5'),
				array('id' => 9, 'titre' => 'Livre 9')
		);
	
		return $this->render('Rx7BookBundle::nav.html.twig', array(
				'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
		));
	}
}