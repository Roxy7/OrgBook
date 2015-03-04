<?php

namespace Rx7\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('Rx7UserBundle:Default:index.html.twig', array('name' => $name));
    }
}
