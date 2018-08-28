<?php

namespace CalendrierBundle\Controller;

use CalendrierBundle\Utils\CalendrierMoniteur;
use CalendrierBundle\Utils\CalendrierPrivee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTime;

/**
 * Description of CalendrierController
 *
 * @author joel
 */

class CalendrierController extends Controller{
    
    
    // Calendrier User
    function calendrierAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service'); 
        $calendrierService =$this->get('calendrier_service');        
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);
        $cal->setDateCourante($calendrierService->getDatePivot());        
        return $this->render("CalendrierBundle:Calendrier:calendrierPrivee.html.twig",array('cal'=>$cal,'user'=>$user) );
    }
    
    // Calendrier Moniteur
    function calendrierMoniteurAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service');
        $calendrierService =$this->get('calendrier_service'); 
        $reservations=$userService->getAllReservationsFromMoniteur($user->getId());
        $cal = new CalendrierMoniteur($reservations,$user);
        $cal->setDateCourante($calendrierService->getDatePivot());
        return $this->render("CalendrierBundle:Calendrier:calendrierMoniteur.html.twig",array('cal'=>$cal,'user'=>$user) );
    }    
    
    // recharge le contenu du calendrier
    function calendrierContenuAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);        
        return new Response($cal->display());
    }
    

    // Pagination par semaine du calendrier
    function paginationAction(Request $request){
        $user = $this->getUser();
        $datePivotString=$request->request->get('datePivot'); 
        $datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);        
        $cal->setDateCourante($datePivot);
        return new Response($cal->display());
    }

}
