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
    
    public function reserveDate($client,$tabDate){
        $client->setSolde($client->getSolde()-sizeof($tabDate));
        foreach ($tabDate as $dateString){            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = new Reservation();
            $resa->setClient($client);
            $resa->setEtatReservation("Réserver");
            $resa->setDateReservation($dateTime);
            $this->entityManager->persist($resa);
            $this->entityManager->flush();
        }         
    }
    
    public function disponible($date){
        return $this->entityManager->getRepository("ReservationBundle:Reservation")->findResaBydate($date) ==null;
    }
}
