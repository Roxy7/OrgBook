<?php

namespace Rx7\BookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Rx7BookBundle:Default:index.html.twig', array('name' => $name));
    }
}
