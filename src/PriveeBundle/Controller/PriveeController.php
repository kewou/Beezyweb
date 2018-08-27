<?php

namespace PriveeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PriveeController extends Controller{
    
    public function indexAction(){
        $user = $this->getUser();
        return $this->render('PriveeBundle:Privee:index.html.twig',array('user' => $user));
    }
}
