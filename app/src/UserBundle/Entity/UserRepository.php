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
        $query = "SELECT * FROM user U where U.roles not like '%ROLE_ADMIN%' AND U.roles not like '%SUPER_ADMIN%'";
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }   
    
    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function findAllUsersByFiltre($nomClient,$idAdmin){		
        $query = "SELECT * FROM user U where U.roles not like '%ROLE_ADMIN%' AND U.roles not like '%SUPER_ADMIN%' AND U.nom like :filtre AND
                 U.administrateur_id=:idAdmin";		                  
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('filtre', '%'.$nomClient.'%');
        $statement->bindValue('idAdmin', $idAdmin);
        $statement->execute();        
        return $statement->fetchAll();
    }    
    
    /**
     * @Secure(roles="ROLE_SUPER_ADMIN")
     */
    public function findAllMoniteurs($idEntreprise){		
        $query = "SELECT * FROM user U where U.entreprise_id =:idEntreprise AND (U.roles like '%ROLE_SUPER_ADMIN%' 
		          or U.roles like '%ROLE_ADMIN%') ";
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
		$statement->bindValue('idEntreprise', $idEntreprise);
        $statement->execute();
        return $statement->fetchAll();        
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
        $query = 'SELECT * FROM reservation R WHERE R.client_id =:idUser AND R.dateDebut >= CAST(CURRENT_TIMESTAMP AS DATE);';
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('idUser', $idUser);
        $statement->execute();
        return $statement->fetchAll();        
    }
    
}
