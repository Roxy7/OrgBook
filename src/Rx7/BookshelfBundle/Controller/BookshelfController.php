<?php
namespace Rx7\BookshelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookshelfBundle\Entity\Bookshelf;
use Rx7\BookshelfBundle\Form\BookshelfType;

class BookshelfController extends Controller
{
	public function addAction()
	{
		$bookshelf = new Bookshelf();
		
		$form = $this->createForm(new BookshelfType, $bookshelf);
		$request = $this->get('request');
		
		
		
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
		
			// On vérifie que les valeurs entrées sont correctes
			// (Nous verrons la validation des objets en détail dans le prochain chapitre)
			if ($form->isValid()) {
					
				$em = $this->getDoctrine()->getManager();
				$em->persist($bookshelf);
				$em->flush();
				 
				 
				$this->get('session')->getFlashBag()->add('info', 'Bibliothèque bien ajouté');
				// On redirige vers la page de visualisation de l'article nouvellement créé
				return $this->redirect($this->generateUrl('rx7bookshelf_show', array('id' => $bookshelf->getId())));
			}
		}
		 
		 
		// Puis modifiez la ligne du render comme ceci, pour prendre en compte l'article :
		return $this->render('Rx7BookshelfBundle:Bookshelf:add.html.twig', array('form' => $form->createView()));
		
	}
	
}