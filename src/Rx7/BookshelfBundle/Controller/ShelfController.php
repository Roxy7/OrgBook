<?php
namespace Rx7\BookshelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Rx7\BookshelfBundle\Entity\Bookshelf;
use Rx7\BookshelfBundle\Entity\Shelf;

class ShelfController extends Controller
{
	public function addAction(Bookshelf $bookshelf)
	{
		$shelf = new Shelf;
		
		$shelf->setPosition(2);
		$shelf->setBookshelf($bookshelf);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($shelf);
		$em->flush();
		
	}
}