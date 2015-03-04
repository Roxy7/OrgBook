<?php

namespace Rx7\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookBundle\Entity\Book;
use Rx7\BookBundle\Entity\Image;
use Rx7\BookBundle\Entity\Author;
use Rx7\BookBundle\Form\BookType;
use Rx7\BookBundle\Form\BookEditType;
use Rx7\BookBundle\Form\ImageType;
use JMS\SecurityExtraBundle\Annotation\Secure;


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
		

		$em = $this->getDoctrine()
               ->getManager();
		$books = $em->getRepository('Rx7BookBundle:Book')
		->findAll();
		
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
	
	/**
	 * @Secure(roles="IS_AUTHENTICATED_REMEMBERED")
	 */
	public function addAction()
	{
			
		$book = new Book();

		$form = $this->createForm(new BookType, $book);
		$request = $this->get('request');
		
		
		if($request->getMethod() == 'POST')
    	{
    		$form->bind($request);
    		
    		// On vérifie que les valeurs entrées sont correctes
    		// (Nous verrons la validation des objets en détail dans le prochain chapitre)
    		if ($form->isValid()) {
    			   			
    			$em = $this->getDoctrine()->getManager();
    			$em->persist($book);
    			$em->flush();
    			
    			
    			$this->get('session')->getFlashBag()->add('info', 'Article bien ajouté');
    			// On redirige vers la page de visualisation de l'article nouvellement créé
    			return $this->redirect($this->generateUrl('rx7book_show', array('id' => $book->getId())));
    		}
    	}
    	
    	
		// Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
		return $this->render('Rx7BookBundle:Book:add.html.twig', array('form' => $form->createView()));
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
    
    $form = $this->createForm(new BookEditType, $book);
    $request = $this->get('request');
    
    
    if($request->getMethod() == 'POST')
    {
    	$form->bind($request);

    	if ($form->isValid()) {
    		 
    		$em->flush();
    
    		$this->get('session')->getFlashBag()->add('info', 'Livre bien modifié');
    		// On redirige vers la page de visualisation de l'article nouvellement créé
    		return $this->redirect($this->generateUrl('rx7book_show', array('id' => $book->getId())));
    	}
    }


		return $this->render('Rx7BookBundle:Book:update.html.twig', array('form' => $form->createView(),
																		  'book' => $book));
	}
	
	/**
	 * @Secure(roles="ROLE_ADMIN")
	 */
	public function deleteAction(Book $book)
	{
		// On crée un formulaire vide, qui ne contiendra que le champ CSRF
		// Cela permet de protéger la suppression d'article contre cette faille
		$form = $this->createFormBuilder()->getForm();
		
		$request = $this->getRequest();
		if ($request->getMethod() == 'POST') {
			$form->bind($request);
		
			if ($form->isValid()) {
				// On supprime l'article
				$em = $this->getDoctrine()->getManager();
				$em->remove($book);
				$em->flush();
		
				// On définit un message flash
				$this->get('session')->getFlashBag()->add('info', 'Livre bien supprimé');
		
				// Puis on redirige vers l'accueil
				return $this->redirect($this->generateUrl('rx7book_index'));
			}
		}
		
		// Si la requête est en GET, on affiche une page de confirmation avant de supprimer
		return $this->render('Rx7BookBundle:Book:delete.html.twig', array(
				'book' => $book,
				'form'    => $form->createView()
		));
	}
	
	public function navAction($number)
	{
		
		$em = $this->getDoctrine()
               ->getManager();
		$books = $em->getRepository('Rx7BookBundle:Book')
		->findLastBooks($number);
	
		return $this->render('Rx7BookBundle::nav.html.twig', array(
				'book_list' => $books // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
		));
	}
}