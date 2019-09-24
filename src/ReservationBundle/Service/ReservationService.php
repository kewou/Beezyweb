<?php

namespace ReservationBundle\Service;

use Doctrine\ORM\EntityManager as EM;
use DateTime;
use ReservationBundle\Entity\Reservation;
use UserBundle\Service\MailService as MailService;

/**
 * Description of ReservationService
 *
 * @author frup73532
 */
class ReservationService {
    
    private $entityManager;
	private $mailService;
    
    public function __construct(EM $em,MailService $mailService) {
        $this->entityManager = $em; 
		$this->mailService = $mailService;
    }
    
    public function reserveDates($client,$tabDate){
        $client->setSolde($client->getSolde()-sizeof($tabDate));
        foreach ($tabDate as $dateString){            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = new Reservation();
            $resa->setClient($client);
            $resa->setEtatReservation("Réserver");
            $resa->setDateReservation($dateTime);
            $this->entityManager->persist($resa);            
        }
        $this->entityManager->flush();		
		
    }
    
    //Par le moniteur
    public function annuleDates($client,$tabDate){
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $tabDate[0]);
        $uneResa=$this->getResaByDate($dateTime);
        $client=$uneResa->getClient();
        $client->setSolde($client->getSolde()+sizeof($tabDate));
        foreach ($tabDate as $dateString){            
            $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneByDateReservation($date);
            $this->entityManager->remove($resa);            
        }
        $this->entityManager->flush();
    }
    
    // Par le client
    public function annuleDate($client,$id){
        $client->setSolde($client->getSolde()+1);
        $resa = $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneById($id);
        $this->entityManager->remove($resa);
        $this->entityManager->flush();        
    }
    
    public function valideDates($lesResasChoisi){
        $reservations = $this->getResaAvalider($lesResasChoisi);
        $tabAssociatifUserResa=$this->associeResaEtUser($reservations);        
        foreach($tabAssociatifUserResa as $clientId => $sesResa){
            foreach($sesResa as $resa){                                               
                $resa->setEtatReservation("Valider"); 
                $this->entityManager->persist($resa);                
            }
            $client=$this->entityManager->getRepository("UserBundle:User")->findOneById($clientId);
        }
        $this->entityManager->flush();
		$this->notifyValidation($client);
    }
    
    public function affecteDates($client,$tabDate){
        $client->setSolde($client->getSolde()-sizeof($tabDate));
        foreach ($tabDate as $dateString){            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = new Reservation();
            $resa->setClient($client);
            $resa->setEtatReservation("Valider");
            $resa->setDateReservation($dateTime);
            $this->entityManager->persist($resa);            
        }
        $this->entityManager->flush();        
    }
    
    public function fermeDates($moniteur,$lesResasChoisi){
        foreach ($lesResasChoisi as $dateString){            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = new Reservation();
            $resa->setClient($moniteur);
            $resa->setEtatReservation("Fermer");
            $resa->setDateReservation($dateTime);
            $this->entityManager->persist($resa);           
        }
        $this->entityManager->flush();
    }
    
    public function disponible($dateString){
        $date=DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
        return $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneByDateReservation($date) ==null;
    }
    
    public function getResaByDate($date){
        return $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneByDateReservation($date);
    } 
    
    private function getResaAvalider($lesResasChoisi){
        $reservations=array();
        foreach($lesResasChoisi as $dateString){            
            $resa=$this->getResaByDate(DateTime::createFromFormat('Y-m-d H:i:s', $dateString));            
            array_push($reservations,$resa);            
        }
        return $reservations;
    }
    
    private function associeResaEtUser($reservations){
        $tabAssociatifUserResa=array();
        foreach($reservations as $resa){
            if(!isset($tabAssociatifUserResa[$resa->getClient()->getId()])){
                $tabResaUser=array();                
                array_push($tabResaUser,$resa);                
                $tabAssociatifUserResa[$resa->getClient()->getId()]=$tabResaUser;
            }else{                               
                $tabResaUser=$tabAssociatifUserResa[$resa->getClient()->getId()];                
                array_push($tabResaUser,$resa);
                $tabAssociatifUserResa[$resa->getClient()->getId()]=$tabResaUser;
            }
        }
        return $tabAssociatifUserResa;
    }
	
    public function notifyValidation($client){
		$message = "Bonjour " . $client->getPrenom() . ",<br>" .
		"<br>" .
		"Une de vos réservations vient d'être validé. <br> Veuillez consulter votre calendrier des rendez-vous en cliquant sur le lien suivant : 
		 https://beezyweb.net/privee/calendrier" ."<br>".
		"<br>" .
		"Bien cordialement" . "<br>" .
		"<br>" .
		"L'équipe Beezyweb." . "<br>" .
		"<br>" .
		"https://beezyweb.net";
		$subject = 'Reservation validee';
		$headers = 'From: beezyweb.net@beezyweb.net'  . "\r\n" .
		'Reply-To: beezyweb.net@beezyweb.net' . "\r\n" .
		'Content-Type: text/html; charset=\"utf-8"' .
		'X-Mailer: PHP/' . phpversion();
        mail($client->getEmail(), $subject, $message, $headers);
	}
	

}
