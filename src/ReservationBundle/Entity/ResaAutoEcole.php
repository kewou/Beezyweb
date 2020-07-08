<?php


namespace ReservationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use ReservationBundle\Entity\Reservation;

/**
 * @ORM\Entity
 *
 * @author frup73532
 */
class ResaAutoEcole extends Reservation{
    
    function getTypeCoiffure() {
        return "null";
    }
}
