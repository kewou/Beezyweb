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
        $moniteurs = $userService->getAllMoniteurs();
        return $this->render('AdminBundle:GestionMoniteur:moniteurs.html.twig',array('moniteurs' => $moniteurs));
    }
    
    public function infosMoniteurAction($id){
        $userService = $this->get('user_service');
        $moniteur = $userService->getUser($id);
        return $this->render('AdminBundle:GestionMoniteur:compteMoniteur.html.twig',array('moniteur' => $moniteur));        
    }
}
