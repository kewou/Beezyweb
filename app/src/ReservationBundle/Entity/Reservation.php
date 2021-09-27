<?php

namespace ReservationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ReservationBundle\Entity\ResaDTO;

/**

 * @ORM\Entity(repositoryClass="ReservationBundle\Entity\ResaRepository")
   @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\Table(name="reservation")

 * @author joel

 */
abstract class Reservation {

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
     * @ORM\Column(name="dateDebut", type="datetime")
     * @ORM\OrderBy({"dateDebut"="ASC"})
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime",nullable=false)
     * @ORM\OrderBy({"dateFin"="ASC"})
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;


    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User", inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;
    
    function getDateDebut() {
        return $this->dateDebut;
    }

    function getDateFin() {
        return $this->dateFin;
    }

    function setDateDebut(\DateTime $dateDebut) {
        $this->dateDebut = $dateDebut;
    }

    function setDateFin(\DateTime $dateFin) {
        $this->dateFin = $dateFin;
    }

    
    function getId() {
        return $this->id;
    }

    function getEtat() {
        return $this->etat;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

    function getClient() {
        return $this->client;
    }

    function setDuree($duree) {
        $this->duree = $duree;
    }

    function setClient($client) {
        $this->client = $client;
    }

    function convertToDTO() {
        $resaDTO = new ResaDTO();
        $resaDTO->setId($this->id);
        $resaDTO->setClientId($this->client->getId());
        $resaDTO->setDate($this->getDateDebut());
        $resaDTO->setEtat($this->getEtat());
        return $resaDTO;
    }

}
