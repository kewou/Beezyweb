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
		if($user->hasRole('ROLE_SUPER_ADMIN')){
			return $this->redirectToRoute('Admin_accueil');
		}else{
			return $this->render('MoniteurBundle:Moniteur:index.html.twig',array('user' => $user));
		}
    }
}

?>