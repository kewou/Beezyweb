<?php

namespace ReservationBundle\Service;

use Doctrine\ORM\EntityManager as EM;
use DateTime;
use ReservationBundle\Entity\Reservation;

/**
 * Description of ReservationService
 *
 * @author frup73532
 */
class ReservationService {
    
    private $entityManager;
    
    public function __construct(EM $em) {
        $this->entityManager = $em;        
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
            // Notifier client
            //echo($client->getNom()+"");
        }
        $this->entityManager->flush();        
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
}
