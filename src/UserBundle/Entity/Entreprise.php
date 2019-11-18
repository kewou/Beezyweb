<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="entreprise")
 * @author joel
 */
class Entreprise {

    /**
     * @var integer     
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="typePlageHoraire", type="integer", length=255)
     */
    private $typePlageHoraire;
	
	function getId(){
		return $this->id;
	}
    
   
   function getNom() {
       return $this->nom;
   }

   function getTypePlageHoraire() {
       return $this->typePlageHoraire;
   }


   function setNom($nom) {
       $this->nom = $nom;
   }

   function setTypePlageHoraire($typePlageHoraire) {
       $this->typePlageHoraire = $typePlageHoraire;
   }



}

?>
