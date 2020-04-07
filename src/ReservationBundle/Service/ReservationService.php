<?php

namespace ReservationBundle\Service;

use Doctrine\ORM\EntityManager as EM;
use DateTime;
use DateInterval;
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
    
    public function reserveDates($client,$tabDate,$color){
        $client->setSolde($client->getSolde()-sizeof($tabDate));
        // Réservation Coiffeur
        if($client->getEntreprise()->getId()==1){
            if($color=="2"){
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $tabDate[0]);
                $resa = new Reservation();
                $resa->setClient($client);
                $resa->setEtat("Réserver");
                $resa->setDateDebut($dateTime);
                $resa->setDuree(60);
                $this->entityManager->persist($resa);            
                $dateTime2= clone $dateTime;
                $dateTime2->add(new DateInterval('PT30M'));           
                $resa2 = new Reservation();
                $resa2->setClient($client);
                $resa2->setEtat("Réserver");
                $resa2->setDateDebut($dateTime2);
                $resa2->setDuree(0);
                $this->entityManager->persist($resa2);                        
            }elseif($color==1){
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $tabDate[0]);
                $resa = new Reservation();
                $resa->setClient($client);
                $resa->setEtat("Réserver");
                $resa->setDateDebut($dateTime);
                $resa->setDuree(30);
                $this->entityManager->persist($resa); 
            }
        }
        else{
            // Résevation Auto-école
            foreach ($tabDate as $dateString){            
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
                $resa = new Reservation();
                $resa->setClient($client);
                $resa->setEtat("Réserver");
                $resa->setDateDebut($dateTime);
                $dateFin= clone $dateTime;
                $dateFin->add(new DateInterval('PT1H')); 
                $resa->setDateFin($dateFin);
                $this->entityManager->persist($resa);            
            }            
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
            $resa = $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneByDateDebut($date);
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
                $resa->setEtat("Valider"); 
                $this->entityManager->persist($resa);                
            }
            $client=$this->entityManager->getRepository("UserBundle:User")->findOneById($clientId);
            //$this->notifyValidation($client);
        }
        $this->entityManager->flush();
        
    }
    
    public function affecteDates($client,$tabDate,$plusDemiehre){
        $client->setSolde($client->getSolde()-sizeof($tabDate));        
        foreach ($tabDate as $dateString){
            if($dateString==="on"){
                continue;
            }else{
                $resa = new Reservation();
                $resa->setClient($client);
                $resa->setEtat("Valider");
                $dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                $resa->setDateDebut($dateDebut);
                $dateFin=clone $dateDebut;
                if($plusDemiehre!="false"){
                    //array_shift($tabDate); // On enlève le premier élément du tableau car il prend l'input du modal "affecter".
                    $dateFin->add(new DateInterval('PT1H30M'));                
                    $resa->setDateFin($dateFin);
                    $client->setSolde($client->getSolde()-0.5);
                }else{
                    $dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                    $dateFin=clone $dateDebut;
                    $dateFin->add(new DateInterval('PT1H'));                 
                    $resa->setDateFin($dateFin);
                }
            }
            $this->entityManager->persist($resa);            
        }
        $this->entityManager->flush();        
    }
    
    public function fermeDates($moniteur,$lesResasChoisi){
        foreach ($lesResasChoisi as $dateString){            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = new Reservation();
            $resa->setClient($moniteur);
            $resa->setEtat("Fermer");
            $resa->setDateDebut($dateTime);
            $resa->setDateFin($dateTime);
            $this->entityManager->persist($resa);           
        }
        $this->entityManager->flush();
    }
    
    public function disponible($dateString,$client){
        $dateDebut=DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
		$criteres = array('dateDebut' => $dateDebut, 'client' => $client);
		$res=$this->entityManager->getRepository("ReservationBundle:Reservation")->findBy($criteres);		
        return count($res)==0;
    }
    
    public function getResaByDate($date){
        return $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneByDateDebut($date);
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
		"Votre planning a été mis à jour. <br> Veuillez consulter votre calendrier des rendez-vous en cliquant sur le lien suivant : 
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
