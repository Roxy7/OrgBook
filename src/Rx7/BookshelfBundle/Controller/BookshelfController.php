<?php
namespace Rx7\BookshelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookshelfBundle\Entity\Bookshelf;
use Rx7\BookshelfBundle\Form\BookshelfType;
use Rx7\BookshelfBundle\Form\BookshelfEditType;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Rx7\BookshelfBundle\Entity\Shelf;

class BookshelfController extends Controller
{
	
	public function indexAction()
	{
	
		$em = $this->getDoctrine()
		->getManager();
		$bookshelf = $em->getRepository('Rx7BookshelfBundle:Bookshelf')
		->findAll();
	
		return $this->render('Rx7BookshelfBundle:Bookshelf:index.html.twig', array(
				'bookshelf_list' => $bookshelf // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
		));
	}
	
	/**
	 * @Secure(roles="IS_AUTHENTICATED_REMEMBERED")
	 */
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
	
	/**
	 * @Secure(roles="IS_AUTHENTICATED_REMEMBERED")
	 */
	public function updateAction($id)
	{
		// On récupère l'EntityManager
		$em = $this->getDoctrine()
		->getManager();
		
		// On récupère l'entité correspondant à l'id $id
		$bookshelf = $em->getRepository('Rx7BookshelfBundle:Bookshelf')
		->find($id);
		
		if ($bookshelf === null) {
			throw $this->createNotFoundException('Bookshelf [id='.$id.'] inexistant.');
		}
		
		$form = $this->createForm(new BookshelfEditType, $bookshelf);
		$request = $this->get('request');
		
		
		if($request->getMethod() == 'POST')
		{
			$form->bind($request);
		
			if ($form->isValid()) {
				 
				$em->flush();
		
				$this->get('session')->getFlashBag()->add('info', 'Bibliothèque bien modifié');
				// On redirige vers la page de visualisation de l'article nouvellement créé
				return $this->redirect($this->generateUrl('rx7bookshelf_show', array('id' => $bookshelf->getId())));
			}
		}
		
		
		return $this->render('Rx7BookshelfBundle:Bookshelf:update.html.twig', array('form' => $form->createView(),
				'bookshelf' => $bookshelf));
	}
	
	public function showAction($id)
	{
			$repository = $this->getDoctrine()
                     ->getManager()
                     ->getRepository('Rx7BookshelfBundle:Bookshelf');
		$bookshelf = $repository->find($id);
		
		if($bookshelf === null)
		{
			throw $this->createNotFoundException('Bookshelf [id='.$id.'] inexistant.');
		}
		
		return $this->render('Rx7BookshelfBundle:Bookshelf:show.html.twig', array(
				'bookshelf' => $bookshelf
		));
	}
	
	public function navAction()
	{
	
		$em = $this->getDoctrine()
		->getManager();
		$bookshelf = $em->getRepository('Rx7BookshelfBundle:Bookshelf')
		->findAll();
	
		return $this->render('Rx7BookshelfBundle:Bookshelf:nav.html.twig', array(
				'bookshelf_list' => $bookshelf // C'est ici tout l'intérêt : le contrôleur passe les variables nécessaires au template !
		));
	}
	

	
	
	
}