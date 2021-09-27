<?php

namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of AdminController
 *
 * @author frup73532
 */
class AdminController extends Controller{
    
    public function indexAction() {
        $user=$this->getUser();
        return $this->render('AdminBundle:Admin:index.html.twig',array('user' => $user));
    }   
    
    
}
