<?php

namespace ReservationBundle\Controller;

use CalendrierBundle\Utils\CalendrierMoniteur;
use CalendrierBundle\Utils\CalendrierPrivee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Description of ReservationController
 *
 * @author joel
 */
class ReservationController extends Controller{
    
            
    function reserverAction(){        
        $tabDate=$this->getDatesChoisi();
        $resaService = $this->get('reservation_service'); 
        $resaService->reserveDates($this->getUser(),$tabDate);       
        $user = $this->getUser();
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);                
        return new Response($cal->display());                              
    }
    
    function annulerUserAction(){
        $request = Request::createFromGlobals();               
        $idResa= $request->request->get('idResa');
        $resaService = $this->get('reservation_service');        
        $resaService->annuleDate($this->getUser(),$idResa);                            
        return new Response("");                              
    }
    
    function annulerMoniteurAction(){
        $user = $this->getUser();
        $tabDate=$this->getDatesChoisi();
        $userService = $this->get('user_service'); 
        $resaService = $this->get('reservation_service'); 
        $resaService->annuleDates($this->getUser(),$tabDate);       
        $users = $userService->getAllUsersMoniteur($user->getId());                              
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierMoniteur($reservations,$users);                
        return new Response($cal->display());                              
    }
    
    function validerAction(){
        $tabDate=$this->getDatesChoisi();
        $userService = $this->get('user_service');  
        $resaService = $this->get('reservation_service');        
        $resaService->valideDates($tabDate);
        $idMonitieur = $this->getUser()->getId();
        $users = $userService->getAllUsersMoniteur($idMonitieur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMonitieur);
        $cal = new CalendrierMoniteur($reservations,$users);
        return new Response($cal->display());                  
    }
    
    function fermerAction(){
        $tabDate=$this->getDatesChoisi();
        $userService = $this->get('user_service');  
        $resaService = $this->get('reservation_service');        
        $resaService->fermeDates($this->getUser(),$tabDate);
        $idMonitieur = $this->getUser()->getId();
        $users = $userService->getAllUsersMoniteur($idMonitieur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMonitieur);
        $cal = new CalendrierMoniteur($reservations,$users);
        $users = $userService->getAllUsersMoniteur($idMonitieur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMonitieur);
        $cal = new CalendrierMoniteur($reservations,$users);        
        return new Response($cal->display());        
    }
    
    function affecterAction(){
        $request = Request::createFromGlobals();
        $tabDate=$request->request->get('lesResaChoisi');
        $nomClient=$request->request->get('nom');
        $userService = $this->get('user_service');  
        $resaService = $this->get('reservation_service');
        $client=$userService->getUserByName($nomClient);
        $resaService->affecteDates($client,$tabDate);
        $idMonitieur = $this->getUser()->getId();
        $users = $userService->getAllUsersMoniteur($idMonitieur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMonitieur);
        $cal = new CalendrierMoniteur($reservations,$users);
        return new Response($cal->display());  
    }  
    
    private function getDatesChoisi(){
        $request = Request::createFromGlobals();
        $tabDate = $request->request->get('lesResaChoisi');
        return $tabDate;
        
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
                return new Response($tabControle);
            }
            if($date < date("Y-m-d H:i:s")){
                $tabControle="Vous avez essayer de choisir une date déja passée !";
                return new Response($tabControle);
            }
        }        
        if($client->getSolde()<sizeof($dates)){
            $tabControle="Vous ne possedez pas assez de jeton pour effectuer cette action !";
        }
        return new Response($tabControle);
    }
    
    function controleActionMoniteurAction(){
        $tabControle="";
        return new Response($tabControle);
    }
    
    // Liste nom clients
    function listeNomClientAction(Request $request){
        $filtre=$request->query->get('term');                
        $tabUserDTO=array();
        $userService = $this->get('user_service'); 
        $users=$userService->getAllUsersByFiltre($filtre);        
        
        foreach($users as $user){                        
            array_push($tabUserDTO,$userService->getUserDTO($user));            
        }        
        return new JsonResponse($tabUserDTO);
    }
    

    
    
}
