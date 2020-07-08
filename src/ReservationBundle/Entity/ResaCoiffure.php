<?php

namespace ReservationBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use ReservationBundle\Entity\Reservation;



/**

 * @ORM\Entity

 * @author joel

 */
class ResaCoiffure extends Reservation{
    
    /**
     * @var string
     * @ORM\Column(name="typeCoiffure", type="string",length=255)
     */
    protected $typeCoiffure;
    
    function getTypeCoiffure() {
        return $this->typeCoiffure;
    }

    function setTypeCoiffure($typeCoiffure) {
        $this->typeCoiffure = $typeCoiffure;
    }


}
