<?php

namespace MoniteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MoniteurBundle:Default:index.html.twig');
    }
}
