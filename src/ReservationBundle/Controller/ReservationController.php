<?php

namespace ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use CalendrierBundle\Utils\CalendrierPrivee;
use DateTime;


/**
 * Description of ReservationController
 *
 * @author joel
 */
class ReservationController extends Controller{
    
            
    function reserverAction(){        
        $request = Request::createFromGlobals();
        $tabDate = $request->request->get('lesResaChoisi');                
        $resaService = $this->get('reservation_service'); 
        $resaService->reserveDate($this->getUser(),$tabDate);       
        $user = $this->getUser();
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);                
        return new Response($cal->display());                              
    }
    
    function  controleReservationAction(){
        $request = Request::createFromGlobals();
        $dates = $request->request->get('lesResaChoisi');        
        $client = $this->getUser();
        $tabControle="";
        $resaService = $this->get('reservation_service');
        foreach($dates as $date){
            if(!$resaService->disponible($date)){
                $tabControle="Vous avez essayer de choisir une date déja réservée !";
                return $tabControle;
            }
            if($date < date("Y-m-d H:i:s")){
                $tabControle="Vous avez essayer de choisir une date déja passée !";
                return $tabControle;
            }
        }        
        if($client->getSolde()<sizeof($dates)){
            $tabControle="Vous ne possedez pas assez de jeton pour effectuer cette action !";
        }
        return new Response($tabControle);
    }        
}
