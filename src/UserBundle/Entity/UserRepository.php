<?php

namespace UserBundle\Entity;

use Doctrine\ORM\EntityRepository;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Description of UserRepository
 *
 * @author frup73532
 */
class UserRepository extends EntityRepository{
    
    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function findAllUsers(){
        return $this->getEntityManager()->createQuery('SELECT U FROM UserBundle:User U where U.id !=1 and U.moniteur is not NULL')->getResult();
    }
    
    public function findAllMoniteurs(){
       return $this->getEntityManager()->createQuery('SELECT U FROM UserBundle:User U where U.id !=1 and U.moniteur is  NULL')->getResult(); 
    }
    
    /**
     * @Secure(roles="ROLE_MONITEUR")
     */
    /*
    public function findUsersByMoniteur($idMoniteur){           
        return $this->getEntityManager()->createQuery('SELECT U FROM UserBundle:User U where U.moniteur.id is not NULL')->getResult();
    }
    */
}
