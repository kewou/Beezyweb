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
    
    public function getReservations($idUser){
        return $this->entityManager->getRepository('UserBundle:User')->findReservations($idUser);
    }
    
    
}
