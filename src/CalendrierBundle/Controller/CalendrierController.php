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
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);        
        return $this->render("CalendrierBundle:Calendrier:calendrierPrivee.html.twig",array('cal'=>$cal) );
    }
    
    function calendrierMoniteurAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service');
        $reservations=$userService->getAllReservationsMoniteur($user->getId());
        $cal = new CalendrierMoniteur($reservations,$user);
        return $this->render("CalendrierBundle:Calendrier:calendrierMoniteur.html.twig",array('cal'=>$cal) );
    }
    

    

}
