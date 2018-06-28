<?php

namespace UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of UserRepository
 *
 * @author frup73532
 */
class UserRepository extends EntityRepository{
    
    public function findAllUsers(){
        return $this->getEntityManager()->createQuery('SELECT u FROM UserBundle:User u where u.id !=1')->getResult();
    }
    
}
