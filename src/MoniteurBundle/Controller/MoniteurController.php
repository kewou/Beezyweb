<?php

namespace MoniteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Description of MoniteurController
 *
 * @author frup73532
 */
class MoniteurController extends Controller{
    
    public function indexAction(){
        $user = $this->getUser();
        return $this->render('MoniteurBundle:Moniteur:index.html.twig',array('user' => $user));
    }
}

?>