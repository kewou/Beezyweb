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
        return $this->getEntityManager()->createQuery("SELECT U FROM UserBundle:User U where U.roles not like '%ROLE_ADMIN%' AND
                                                                                             U.roles not like '%SUPER_ADMIN%' ")->getResult();
    }
    
    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function findAllMoniteurs(){
       return $this->getEntityManager()->createQuery("SELECT U FROM UserBundle:User U where U.roles like '%ROLE_ADMIN%'")->getResult(); 
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")     
     */
    public function findUsersByMoniteur($idMoniteur){
        $query = 'SELECT * FROM user U WHERE U.moniteur_id =:idMoniteur;';
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('idMoniteur', $idMoniteur);
        $statement->execute();
        return $statement->fetchAll();
    }
    
    /**
     * @Secure(roles="ROLE_ADMIN")     
     */
    public function findReservations($idUser){
        $query = 'SELECT * FROM reservation R WHERE R.client_id =:idUser;';
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('idUser', $idUser);
        $statement->execute();
        return $statement->fetchAll();        
    }
    
}
