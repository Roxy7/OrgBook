<?php
namespace Rx7\BookshelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookshelfBundle\Entity\Bookshelf;
use Rx7\BookshelfBundle\Entity\Shelf;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ShelfController extends Controller
{
	/**
	 * @Secure(roles="IS_AUTHENTICATED_REMEMBERED")
	 */
	public function addShelfAction($id)
	{
		
		$repository = $this->getDoctrine()
		->getManager()
		->getRepository('Rx7BookshelfBundle:Bookshelf');
		$bookshelf = $repository->find($id);
		
		if($bookshelf === null)
		{
			throw $this->createNotFoundException('Bookshelf [id='.$id.'] inexistant.');
		}
		
		$shelf = new Shelf();
		$shelf->setPosition('1');
		$shelf->setBookshelf($bookshelf);
		$em = $this->getDoctrine()->getManager();
		$em->persist($shelf);
		$em->flush();
		
		return $this->redirect($this->generateUrl('rx7bookshelf_show', array('id' => $id)));

	}
	
	
}