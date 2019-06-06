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
    
    public function getAllUsersByFiltre($filtre){
        return $this->entityManager->getRepository('UserBundle:User')->findAllUsersByFiltre($filtre);
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
    
    public function getUserByName($nom){
        return $this->entityManager->getRepository('UserBundle:User')->findOneByNom($nom);
    }
    
    public function deleteUser($id){ 
        $user = $this->entityManager->getRepository('UserBundle:User')->findOneById($id);    
        $this->entityManager->remove($user);
        $this->entityManager->flush();        
    }
    
    public function getReservationsByClient($idUser){
        return $this->entityManager->getRepository('UserBundle:User')->findReservations($idUser);
    }
    
    public function affecteMoniteurDefault($user){
        $moniteur=$this->getUser(1);
        $user->setMoniteur($moniteur);        
        $this->entityManager->flush();
    }
    
    public function affecteMoniteur($user,$idMoniteur){
        $moniteur=$this->getUser($idMoniteur);
        $user->setMoniteur($moniteur);        
        $this->entityManager->flush();
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
    
    public function getEM(){
        return $this->entityManager;
    }
    
    // Retourne un user DTO
    public function getUserDTO($client){
        $userDTO=$client['nom'];
        //$userDTO=array("id"=>$client['id'],"nom"=>$client['nom'],"prenom"=>$client['prenom']);
        
        //$userDTO = new UserDTO($client['id'],$client['nom'],$client['prenom']);
        return $userDTO;
    }
    
    
}
