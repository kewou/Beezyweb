<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ReservationBundle\Entity\ResaRepository")
 * @ORM\Table(name="reservation")
 * @author joel
 */
class Reservation {
            
    /**
     * @var integer     
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReservation", type="datetime")
     */
    private $dateReservation;

    /**
     * @var string
     *
     * @ORM\Column(name="etatReservation", type="string", length=255)
     */
    private $etatReservation;
    
   /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
   protected $client;
   



   function getClient() {
       return $this->client;
   }

   function setClient($client) {
       $this->client = $client;
   }
   
   function getId() {
       return $this->id;
   }

   function getDateReservation() {
       return $this->dateReservation;
   }

   function getEtatReservation() {
       return $this->etatReservation;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setDateReservation(\DateTime $dateReservation) {
       $this->dateReservation = $dateReservation;
   }

   function setEtatReservation($etatReservation) {
       $this->etatReservation = $etatReservation;
   }




   
}


