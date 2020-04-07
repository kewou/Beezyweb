<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="preferences")
 * @author joel
 */
class Preferences {
    
    /**
     * @var integer     
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
   /**
    * @var integer	 
    * @ORM\Column(name="$nombreResaMaxParSemaine", type="integer",nullable=false)
    */
    private $nombreResaMaxParSemaine;
    
   /**
    * @var integer	 
    * @ORM\Column(name="$nombreResaMaxParJour", type="integer",nullable=false)
    */
    private $nombreResaMaxParJour;
    
    function getId() {
        return $this->id;
    }

    function getNombreResaMaxParSemaine() {
        return $this->nombreResaMaxParSemaine;
    }

    function getNombreResaMaxParJour() {
        return $this->nombreResaMaxParJour;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombreResaMaxParSemaine($nombreResaMaxParSemaine) {
        $this->nombreResaMaxParSemaine = $nombreResaMaxParSemaine;
    }

    function setNombreResaMaxParJour($nombreResaMaxParJour) {
        $this->nombreResaMaxParJour = $nombreResaMaxParJour;
    }


    
}
