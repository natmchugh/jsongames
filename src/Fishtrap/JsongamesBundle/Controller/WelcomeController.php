<?php

namespace Fishtrap\JsongamesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{

    public function indexAction()
    {
        return $this->render('FishtrapJsongamesBundle:Welcome:index.html.twig');
    }

    public function aboutAction()
    {
        
    }
}