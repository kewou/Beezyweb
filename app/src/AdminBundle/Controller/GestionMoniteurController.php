<?php

namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of GestionMoniteurController
 *
 * @author frup73532
 */
class GestionMoniteurController extends Controller {    
    
    public function moniteursAction() {
        $userService = $this->get('user_service');
        $user=$this->getUser();
        $moniteurs = $userService->getAllMoniteurs($this->getUser()->getEntreprise()->getId());
        return $this->render('AdminBundle:GestionMoniteur:moniteurs.html.twig',array('moniteurs' => $moniteurs,'user'=>$user));
    }
    
    public function infosMoniteurAction($id){
        $userService = $this->get('user_service');
        $moniteur = $userService->getUser($id);
        return $this->render('AdminBundle:GestionMoniteur:compteMoniteur.html.twig',array('moniteur' => $moniteur));        
    }
}
