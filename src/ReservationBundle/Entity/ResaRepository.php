<?php


namespace ReservationBundle\Entity;
use Doctrine\ORM\EntityRepository;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Description of ResaRepository
 *
 * @author frup73532
 */
class ResaRepository extends EntityRepository{
    
    
     /**
     * @Secure(roles="ROLE_USER")
     */
    public function findResaBydate($date){
        $query="SELECT R FROM ReservationBundle:Reservation R where R.dateReservation=:date";
        $statement = $this->getEntityManager()->getConnection()->prepare($query);
        $statement->bindValue('date', $date);
        return $statement->fetch();
    }          
}
