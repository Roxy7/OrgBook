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
						'titre'   => 'Livre 1',
						'id'      => 1,
						'auteur'  => 'winzou',
						'contenu' => 'Ce weekend était trop bien. Blabla…',
						'date'    => new \Datetime()),
				array(
						'titre'   => 'Livre 2',
						'id'      => 2,
						'auteur' => 'winzou',
						'contenu' => 'Bientôt prêt pour le jour J. Blabla…',
						'date'    => new \Datetime()),
				array(
						'titre'   => 'Livre 3',
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
		// On récupère l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();

    // On récupère l'entité correspondant à l'id $id
    $book = $em->getRepository('Rx7BookBundle:Book')
                  ->find($id);

    if ($book === null) {
      throw $this->createNotFoundException('Book[id='.$id.'] inexistant.');
    }

    // On récupère toutes les catégories :
    $list_categories = $em->getRepository('Rx7BookBundle:Category')
                           ->findAll();

    // On boucle sur les catégories pour les lier à l'article
    foreach($list_categories as $category)
    {
      $book->addCategory($category);
    }

    // Inutile de persister l'article, on l'a récupéré avec Doctrine

    // Étape 2 : On déclenche l'enregistrement
    $em->flush();

    return new Response('OK');
		

		return $this->render('Rx7BookBundle:Book:update.html.twig', array(
				'book' => $book
		));
	}
	
	public function deleteAction($id)
	{
		// On récupère l'EntityManager
    $em = $this->getDoctrine()
               ->getManager();

    // On récupère l'entité correspondant à l'id $id
    $book = $em->getRepository('Rx7BookBundle:Book')
                  ->find($id);

    if ($book === null) {
      throw $this->createNotFoundException('Book[id='.$id.'] inexistant.');
    }

    // On récupère toutes les catégories :
    $list_categories = $em->getRepository('Rx7BookBundle:Category')
                           ->findAll();

    // On enlève toutes ces catégories de l'article
    foreach($list_categories as $category)
    {
      // On fait appel à la méthode removeCategorie() dont on a parlé plus haut
      // Attention ici, $categorie est bien une instance de Categorie, et pas seulement un id
      $book->removeCategory($category);
    }

    // On n'a pas modifié les catégories : inutile de les persister

    // On a modifié la relation Article - Categorie
    // Il faudrait persister l'entité propriétaire pour persister la relation
    // Or l'article a été récupéré depuis Doctrine, inutile de le persister

    // On déclenche la modification
    $em->flush();

    return new Response('OK');
	}
	
	public function navAction($nombre)
	{
		// On fixe en dur une liste ici, bien entendu par la suite on la récupérera depuis la BDD !
		$liste = array(
				array('id' => 1, 'titre' => 'Livre 1'),
				array('id' => 2, 'titre' => 'Livre 2'),
				array('id' => 3, 'titre' => 'Livre 3')
		);
	
		return $this->render('Rx7BookBundle::nav.html.twig', array(
				'liste_articles' => $liste // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
		));
	}
}