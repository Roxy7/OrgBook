<?php

namespace Rx7\BookshelfBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Rx7BookshelfBundle:Default:index.html.twig', array('name' => $name));
    }
}
