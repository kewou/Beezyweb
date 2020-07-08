<?php

namespace ReservationBundle\Service;

use Doctrine\ORM\EntityManager as EM;
use DateTime;
use DateInterval;
use ReservationBundle\Entity\ResaAutoEcole;
use ReservationBundle\Entity\ResaCoiffure;
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
                $client->setSolde($client->getSolde()-1);
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $tabDate[0]);
                $resa = new ResaCoiffure();
                $resa->setClient($client);
                $resa->setEtat("Réserver");
                $resa->setDateDebut($dateTime);
                $dateFin= clone $dateTime;
                $dateFin->add(new DateInterval('PT30M'));
                $resa->setDateFin($dateFin);
                $resa->setTypeCoiffure("Complexe");
                $this->entityManager->persist($resa);            
                           
                $resa2 = new ResaCoiffure();
                $resa2->setClient($client);
                $resa2->setEtat("Réserver");
                $dateDebut2=clone $dateFin;
                $resa2->setDateDebut($dateDebut2);
                $dateFin2=clone $dateFin;
                $dateFin2->add(new DateInterval('PT30M'));
                $resa2->setTypeCoiffure("NA");
                $resa2->setDateFin($dateFin2);
                $this->entityManager->persist($resa2);                        
            }elseif($color==1){
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $tabDate[0]);
                $resa = new ResaCoiffure();
                $resa->setClient($client);
                $resa->setEtat("Réserver");
                $resa->setDateDebut($dateTime);
                $resa->setTypeCoiffure("Simple");
                $resa->setDuree(30);
                $dateFin= clone $dateTime;
                $dateFin->add(new DateInterval('PT30M'));
                $resa->setDateFin($dateFin);
                $this->entityManager->persist($resa); 
            }
        }
        else{
            // Résevation Auto-école
            foreach ($tabDate as $dateString){            
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
                $resa = new ResaAutoEcole();
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
        if($resa->getTypeCoiffure()=="Complexe"){
            $client->setSolde($client->getSolde()+1);
            $idResaFictive=$id+1;
            $resaFictive = $this->entityManager->getRepository("ReservationBundle:Reservation")->findOneById($idResaFictive);
            $this->entityManager->remove($resaFictive);
        }
        
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
            $this->notifyValidation($client);
        }
        $this->entityManager->flush();
        
    }
    
    public function affecteDates($client,$tabDate,$plusDemiehre){
        $client->setSolde($client->getSolde()-sizeof($tabDate));
        if($client->getEntreprise()->getId()==2){
            foreach ($tabDate as $dateString){
                if($dateString==="on"){
                    continue;
                }else{
                    $resa = new ResaAutoEcole();
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
                        $dateFin->add(new DateInterval('PT1H'));                 
                        $resa->setDateFin($dateFin);
                    }
                }
                $this->entityManager->persist($resa);            
            }
        }else{
            foreach ($tabDate as $dateString){
                if($dateString==="on"){
                        continue;
                }else{
                        $resa = new ResaCoiffure();
                        $resa->setClient($client);
                        $resa->setEtat("Valider");
                        $dateDebut = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                        $resa->setDateDebut($dateDebut);
                        $dateFin=clone $dateDebut;
                        $dateFin->add(new DateInterval('PT30M')); 
                        $resa->setDateFin($dateFin);
                        $resa->setTypeCoiffure("Simple");
                }
            $this->entityManager->persist($resa);
            }
        }
        $this->entityManager->flush();        
    }
    
    public function fermeDates($moniteur,$lesResasChoisi){
        if($moniteur->getEntreprise()->getId()==2){
            foreach ($lesResasChoisi as $dateString){            
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
                $resa = new ResaAutoEcole();
                $resa->setClient($moniteur);
                $resa->setEtat("Fermer");
                $resa->setDateDebut($dateTime);
                $resa->setDateFin($dateTime);
                $this->entityManager->persist($resa);           
            }
        }else{
            foreach ($lesResasChoisi as $dateString){ 
                $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
                $resa = new ResaCoiffure();
                $resa->setClient($moniteur);
                $resa->setEtat("Fermer");
                $resa->setDateDebut($dateTime);
                $resa->setDateFin($dateTime);
                $resa->setTypeCoiffure("Simple");
                $this->entityManager->persist($resa);
            }
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
		$message = $this->contenuMail($client);
		
		$subject = 'Reservation validee';
		$headers = 'From: beezyweb.net@beezyweb.net'  . "\r\n" .
		'Reply-To: beezyweb.net@beezyweb.net' . "\r\n" .
		'Content-Type: text/html; charset=\"utf-8"' .
		'X-Mailer: PHP/' . phpversion();
        mail($client->getEmail(), $subject, $message, $headers);
	}
	
	private function contenuMail($client){
		return '
		<!DOCTYPE html>
		<html>
		<head>
		<meta charset="UTF-8">
		</head>

		<body>
             <h3>Bonjour '  . $client->getPrenom() . ', </h3>.
		
		     <p>Votre planning a été mis à jour. <br> Veuillez consulter votre calendrier des rendez-vous en cliquant sur le lien suivant : </p> 
		     <a href="https://beezyweb.net/privee/profile/profil">Mes rendez-vous</a> .<br>.
		
		     <p>Bien cordialement. <br>		
		     L\' équipe Beezyweb.  </p>
		
		    <p><a href="https://beezyweb.net">https://beezyweb.net</a></p>
		</body>

		</html>';
	}
	
}
