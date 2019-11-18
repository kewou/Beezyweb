<?php


namespace UserBundle\Entity;

/**
 * Description of UserDTO
 *
 * @author frup73532
 */
class UserDTO {
    
    private $id;
    private $nom;
    private $prenom;
    
    function __construct($id, $nom, $prenom) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }


}
