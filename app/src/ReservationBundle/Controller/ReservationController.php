<?php

namespace ReservationBundle\Controller;

use CalendrierBundle\Utils\CalendrierMoniteur;
use CalendrierBundle\Utils\CalendrierPrivee;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use DateTime;


/**
 * Description of ReservationController
 *
 * @author joel
 */
class ReservationController extends Controller{
    
            
    function reserverAction(Request $request){        
        $tabDate=$request->request->get('lesResaChoisi');
        $color=$request->request->get('color');
		$datePivotString=$request->request->get('datePivot');
		$datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);		
        $resaService = $this->get('reservation_service'); 
        $resaService->reserveDates($this->getUser(),$tabDate,$color);       
        $user = $this->getUser();
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);
		$cal->setDateCourante($datePivot);
        return new Response($cal->display());                              
    }
    
    function annulerUserAction(Request $request){                     
        $idResa= $request->request->get('idResa');
        $resaService = $this->get('reservation_service');        
        $resaService->annuleDate($this->getUser(),$idResa);                            
        return new Response("");                              
    }
    
    function annulerContenuAction(Request $request){                      
        $idResa= $request->request->get('idResa');
		$user=$this->getUser();
        $resaService = $this->get('reservation_service');        
        $resaService->annuleDate($user,$idResa);
        return $this->render("PriveeBundle:Privee:mesResa.html.twig",array('user' => $user));
    }
    
    function annulerMoniteurAction(Request $request){        
		$idMoniteur=$this->getMoniteurId($request);
        $tabDate=$request->request->get('lesResaChoisi');
		$datePivotString=$request->request->get('datePivot');
		$datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);		
        $userService = $this->get('user_service'); 
        $resaService = $this->get('reservation_service'); 
        $resaService->annuleDates($this->getUser(),$tabDate);       
        $users = $userService->getAllUsersMoniteur($idMoniteur);                              
        $reservations = $userService->getAllReservationsFromClient($idMoniteur);
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users); 
		$cal->setDateCourante($datePivot);		
        return new Response($cal->display());                              
    }
    
    function validerAction(Request $request){
        $tabDate=$request->request->get('lesResaChoisi');
		$datePivotString=$request->request->get('datePivot');
		$datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);		
        $userService = $this->get('user_service');  
        $resaService = $this->get('reservation_service');        
        $resaService->valideDates($tabDate);
        $idMoniteur=$this->getMoniteurId($request);
        $users = $userService->getAllUsersMoniteur($idMoniteur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMoniteur);
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users);
		$cal->setDateCourante($datePivot); 
        return new Response($cal->display());                  
    }
    
    function fermerAction(Request $request){        
        $idMoniteur=$this->getMoniteurId($request);		
        $tabDate=$request->request->get('lesResaChoisi');
		$datePivotString=$request->request->get('datePivot');
		$datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);
        $userService = $this->get('user_service');  
        $resaService = $this->get('reservation_service');        
        $resaService->fermeDates($userService->getUser($idMoniteur),$tabDate);				
        $users = $userService->getAllUsersMoniteur($idMoniteur);
        $reservations=$userService->getAllReservationsFromMoniteur($idMoniteur);              
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users);
		$cal->setDateCourante($datePivot);        
        return new Response($cal->display());        
    }
    
    function affecterAction(Request $request){        
		$idMoniteur=$this->getMoniteurId($request);		
        $tabDate=$request->request->get('lesResaChoisi');
		$datePivotString=$request->request->get('datePivot');
		$datePivot=datetime::createfromformat('Y-m-d H:i:s',$datePivotString);		
        $nomClient=$request->request->get('nom');
        $plusDemiehre=$request->request->get('plusDemiHeure');
        $userService = $this->get('user_service');  
        $resaService = $this->get('reservation_service');
        $client=$userService->getUserByName($nomClient);
        $resaService->affecteDates($client,$tabDate,$plusDemiehre);        
        $users = $userService->getAllUsersMoniteur($idMoniteur);		
        $reservations=$userService->getAllReservationsFromMoniteur($idMoniteur);
        $cal = new CalendrierMoniteur($reservations,$this->getUser(),$users);
		$cal->setDateCourante($datePivot);
        return new Response($cal->display());  
    }  
    
            
    function  controleReservationAction(Request $request){        
        $dates = $request->request->get('lesResaChoisi');        
        $client = $this->getUser();		
        $tabControle="";
        $resaService = $this->get('reservation_service'); 
        foreach($dates as $date){
            if(!$resaService->disponible($date,$client)){
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
    
    function controleNomClientAction(Request $request){        
        $nomClient = $request->request->get('nom');
        $userService = $this->get('user_service');
        $client=$userService->getUserByName($nomClient);
        if($client==null){
            $erreur="Erreur sur le nom de l'élève recherché !";
        }else{
            $erreur="";
        }                
        return new Response($erreur);
    }
    
    // Liste nom clients par moniteur
    function listeNomClientAction(Request $request){
        $nomClient=$request->query->get('term'); 
        $idMoniteur = intval($request->query->get('idMoniteur'));		
        $tabUserDTO=array();
        $userService = $this->get('user_service'); 
        $users=$userService->getAllUsersByFiltre($nomClient,$idMoniteur);        
        
        foreach($users as $user){
			if($user['moniteur_id'] == $idMoniteur){
				array_push($tabUserDTO,$userService->getUserDTO($user));
			}
        }        
        return new JsonResponse($tabUserDTO);
    }
	
	// Détermine le moniteur pour la construction du calendrier
	function getMoniteurId($request){
		$idMoniteur = $request->query->get('idMoniteur');		
		if($idMoniteur == null){		
			$idMoniteur = $this->getUser()->getId();		
		}else{
			$idMoniteur=intval($idMoniteur);
		}
		return $idMoniteur;
	}
			   
}
