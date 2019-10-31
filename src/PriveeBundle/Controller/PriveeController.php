<?php

namespace PriveeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PriveeController extends Controller{
    
    public function indexAction(){
        $user = $this->getUser();
		if($user->hasRole('ROLE_SUPER_ADMIN')){
			return $this->redirectToRoute('Admin_accueil');
		}
		elseif($user->hasRole('ROLE_ADMIN')){
			return $this->redirectToRoute('Moniteur_accueil');
		}else{
			return $this->render('PriveeBundle:Privee:index.html.twig',array('user' => $user));
		}      
   }
}
