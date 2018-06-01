<?php

namespace PriveeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PriveeController extends Controller
{
    public function indexAction()
    {
        return $this->render('PriveeBundle:Privee:index.html.twig');
    }
}
