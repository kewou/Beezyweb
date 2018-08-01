<?php

namespace CalendrierBundle\Controller;

use CalendrierBundle\Utils\CalendrierPrivee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CalendrierController
 *
 * @author joel
 */
class CalendrierController extends Controller{
    
    function calendrierAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service');
        $clients = $userService->getAllUsersMoniteur($this->getUser()->getMoniteur()->getId());                
        $reservations = array();
        foreach ($clients as $client) {                        
            $lesResas=$userService->getReservations($client['id']);
            foreach ($lesResas as $resa) { 
                array_push($reservations, $resa );
            }                        
        }
        $cal = new CalendrierPrivee($reservations,$user);        
        return $this->render("CalendrierBundle:Calendrier:calendrierPrivee.html.twig",array('cal'=>$cal) );
    }
}
