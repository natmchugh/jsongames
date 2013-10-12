<?php

namespace Fishtrap\BruteforceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{

    public function indexAction()
    {
        return $this->render('FishtrapBruteforceBundle:Welcome:index.html.twig');
    }
}