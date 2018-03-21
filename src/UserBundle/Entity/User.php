<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Email;

/**
 * User
 * @ORM\Entity
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
	 * min = 4,
	 * minMessage = "Le nom est court")	 
	 */
	protected $nom;
	
	/**
	 * @var integer	 
	 * @ORM\Column(name="solde", type="integer",nullable=true)
	 */
	protected $solde=0;
	
	/**
	 * @var float	 
	 * @ORM\Column(name="money", type="float",nullable=true))
	 */
	protected $money=0;
	
	/**
	 * @var string
	 * @Email()
	 */
	protected $email;
	
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
		return $this;
	}
	
	
}