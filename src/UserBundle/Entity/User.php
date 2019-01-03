<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Email;

/**
 * User
 * @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="telephone", message="Ce numéro de téléphone existe déja sur un autre compte !")
 */
class User extends BaseUser {

    /**
     * @var integer	 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct() {
        parent::__construct();
        $this->reservations = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User",mappedBy="moniteur")
     * @var User 
     */
    protected $clients = null;

    /**
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User",inversedBy="clients")
     * @var User 
     */
    protected $moniteur = null;

    /**
     * @ORM\OneToMany(targetEntity="ReservationBundle\Entity\Reservation",mappedBy="client")         
     */
    protected $reservations = null;

    /**
     * @var integer
     * @ORM\Column(name="telephone", type="integer")
     * @Assert\Regex("/^[6-7][0-9]{8}$/",message = "Numero non valide : exemple => 615664758")
     */
    protected $telephone;

    /**
     * @var string
     * @ORM\Column(name="nom", type="string",length=255)
     * @Assert\Length(
     * min = 2,
     * minMessage = "Le nom est court")	 
     */
    protected $nom;

    /**
     * @var string
     * @ORM\Column(name="prenom", type="string",length=255)
     * @Assert\Length(
     * min = 2,
     * minMessage = "Le prenom est court")	 
     */
    protected $prenom;

    /**
     * @var integer	 
     * @ORM\Column(name="solde", type="integer",nullable=true)
     */
    protected $solde = 0;

    /**
     * @var float	 
     * @ORM\Column(name="money", type="float",nullable=true))
     */
    protected $money = 0;

    /**
     * @var string
     * @Email()
     */
    protected $email;

    function getClients() {
        return $this->clients;
    }

    function getMoniteur() {
        return $this->moniteur;
    }

    function setClients(User $clients) {
        $this->clients = $clients;
    }

    function setMoniteur(User $moniteur) {
        $this->moniteur = $moniteur;
    }

    public function getId() {
        return $this->id;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function getSolde() {
        return $this->solde;
    }

    public function setSolde($solde) {
        $this->solde = $solde;
        return $this;
    }

    public function getMoney() {
        return $this->money;
    }

    public function setMoney($money) {
        $this->money = $money;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        $this->setUsername($email);
        return $this;
    }

    function getReservations() {
        return $this->reservations;
    }

    function setReservations($reservations) {
        $this->reservations = $reservations;
    }

}
