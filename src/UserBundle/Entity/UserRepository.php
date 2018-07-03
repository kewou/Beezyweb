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
        return $this->getEntityManager()->createQuery('SELECT U FROM UserBundle:User U where U.id !=4 and U.moniteur is not NULL')->getResult();
    }
    
    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function findAllMoniteurs(){
       return $this->getEntityManager()->createQuery('SELECT U FROM UserBundle:User U where U.moniteur is NULL')->getResult(); 
    }
    
    /**
     * @Secure(roles="ROLE_MONITEUR")     
     */
    public function findUsersByMoniteur($idMoniteur){
        $query = 'SELECT * FROM user U where U.moniteur_id =:idMoniteur;';
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('idMoniteur', $idMoniteur);
        $statement->execute();
        return $statement->fetchAll();
    }
    
}
