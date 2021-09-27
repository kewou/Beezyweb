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
    
    
    // Calendrier Privee
    function calendrierAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service');          
        $calendrierService =$this->get('calendrier_service');        
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = CalendrierPrivee::getInstance($reservations,$user);
        $cal->setDateCourante($calendrierService->getDatePivot());
        if($user->getEntreprise()->getId()==2){
            return $this->render("CalendrierBundle:Calendrier:calendrierPriveeAutoEcole.html.twig",array('cal'=>$cal,'user'=>$user) );
        }else{
            return $this->render("CalendrierBundle:Calendrier:calendrierPriveeCoiffeur.html.twig",array('cal'=>$cal,'user'=>$user) );                
        }
    }
    
    // Calendrier Moniteur
    function calendrierMoniteurAction(){        
        $userService = $this->get('user_service');
        $calendrierService =$this->get('calendrier_service');
		$user=$this->getUser();
        $idMoniteur = $user->getId();        
        $users = $userService->getAllUsersMoniteur($idMoniteur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMoniteur);
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users);
        $cal->setDateCourante($calendrierService->getDatePivot());
        return $this->render("CalendrierBundle:Calendrier:calendrierMoniteur.html.twig",array('cal'=>$cal,'user'=>$user,'idMoniteur'=>$idMoniteur) );
    }
	
    // Calendrier Admin
    function calendrierAdminAction($idMoniteur){		
        $userService = $this->get('user_service');
        $calendrierService =$this->get('calendrier_service');        
        $user=$userService->getUser($idMoniteur);
        $users = $userService->getAllUsersMoniteur($idMoniteur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMoniteur);
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users);
        $cal->setDateCourante($calendrierService->getDatePivot());
        return $this->render("CalendrierBundle:Calendrier:calendrierAdmin.html.twig",array('cal'=>$cal,'user'=>$user,'idMoniteur'=>$idMoniteur) );
    }	

	 
    
    // recharge le contenu du calendrier privee
    function calendrierContenuAction(){
        $user = $this->getUser();
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = CalendrierPrivee::getInstance($reservations,$user);        
        return new Response($cal->display());
    }
    
    // recharge le contenu du calendrier moniteur
    function calendrierMoniteurContenuAction(){
        $idMonitieur = $this->getUser()->getId();
        $userService = $this->get('user_service');
        $users = $userService->getAllUsersMoniteur($idMonitieur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMonitieur);
        $cal = new CalendrierMoniteur($reservations,$users);
        return new Response($cal->display());
    }
    
    // Pagination User par semaine du calendrier
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
    
    //Pagination Moniteur
    function paginationMoniteurAction(Request $request){
        $datePivotString=$request->request->get('datePivot');
        $datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);
        $userService = $this->get('user_service');        
        $idMonitieur = $this->getUser()->getId();
        $users = $userService->getAllUsersMoniteur($idMonitieur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMonitieur);
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users);
        $cal->setDateCourante($datePivot);
        return new Response($cal->display());
    }    

}
