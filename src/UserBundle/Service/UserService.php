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
        return $this->entityManager->getRepository('UserBundle:User')->findAll();
    }
}
