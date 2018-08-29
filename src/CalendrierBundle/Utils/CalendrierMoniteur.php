<?php

namespace CalendrierBundle\Utils;

use CalendrierBundle\Utils\AbstractCalendrier;

/**
 * Description of CalendrierAdmin
 *
 * @author joel
 */
class CalendrierMoniteur extends AbstractCalendrier{
    
    private $users;
    
    function __construct($reservations,$users) {
        parent::__construct($reservations);
        $this->users = $users;
    }
    
    
    public function display() {
       echo("Calendrier Moniteur " . "<br>");
        $this->headCalendrier();
        $this->corpCalendrier();        
    }

    public function afficheCase($date) {        
        $estDispo=true;        
        foreach ($this->reservations as $resa) {            
            $heureResa = $resa['dateReservation']; 
            if($date==$heureResa){
                $estDispo=false;
                if($resa['etatReservation']=="Fermer"){
                    echo ("<input type='checkbox' value='".$date."'>Fermer");
                    break;
                }elseif($resa['etatReservation']=="Réserver"){                    
                    echo ("<input type='checkbox' value='".$date."'>".$this->getNomReserveur($this->users, $resa['client_id'])); 
                    break;
                }
            }         
        }
        if($estDispo){
            echo ("<input type='checkbox' value='".$date."'>Dispo");
        }          
    }
    
    public function getNomReserveur($users,$idClient){        
        foreach ($users as $user) {                         
            if($user['id']===$idClient){                
                return $user['nom'];
            }
        }
    }

}
