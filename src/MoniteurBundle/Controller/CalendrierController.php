<?php

namespace MoniteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CalendrierController
 *
 * @author frup73532
 */
class CalendrierController extends Controller{
    
    
    public function calendrierAction(){
        $userService = $this->get('user_service');
        $clients = $userService->getAllUsersMoniteur($this->getUser()->getId());
        return $this->render('MoniteurBundle:Calendrier:calendrier.html.twig',array('clients' => $clients));
    }
}
