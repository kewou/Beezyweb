<?php

namespace UserBundle\Service;

use Doctrine\ORM\EntityManager as EM;

/**
 * Description of UserService
 *
 * @author frup73532
 */
class UserService {
    
    private $entityManager;
    
    public function __construct(EM $em) {
        $this->entityManager = $em;        
    }
    
    public function getAllUsers(){
        return $this->entityManager->getRepository('UserBundle:User')->findAllUsers();
    }
    
    public function getAllMoniteurs(){
        return $this->entityManager->getRepository('UserBundle:User')->findAllMoniteurs();
    }
    
    public function getAllUsersMoniteur($idMoniteur){
        return $this->entityManager->getRepository('UserBundle:User')->findUsersByMoniteur($idMoniteur);
    }
    
    public function getUser($id){
        return $this->entityManager->getRepository('UserBundle:User')->findOneById($id);
    }
    
    public function deleteUser($id){ 
        $user = $this->entityManager->getRepository('UserBundle:User')->findOneById($id);    
        $this->entityManager->remove($user);
        $this->entityManager->flush();        
    }
    
    public function getReservationsByClient($idUser){
        return $this->entityManager->getRepository('UserBundle:User')->findReservations($idUser);
    }
    
    
    // Retourne toutes les réservations du moniteur de idClient
    public function getAllReservationsFromClient($idClient){
        $clients = $this->getAllUsersMoniteur($this->getUser($idClient)->getMoniteur()->getId());
        $reservations = array();
        foreach ($clients as $client) {                        
            $lesResas=$this->getReservationsByClient($client['id']);
            foreach ($lesResas as $resa) { 
                array_push($reservations, $resa);
            }
        }
        return $reservations;
    }
    
    // Retourne toutes les réservations d'un moniteur
    public function getAllReservationsFromMoniteur($idMoniteur){
        $clients = $this->getAllUsersMoniteur($idMoniteur);
        $reservations = array();
        foreach ($clients as $client) {                        
            $lesResas=$this->getReservationsByClient($client['id']);
            foreach ($lesResas as $resa) { 
                array_push($reservations, $resa );
            }
        }
        return $reservations;
    }
    
    
}
