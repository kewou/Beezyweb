<?php

namespace CalendrierBundle\Utils;

use CalendrierBundle\Utils\AbstractCalendrier;

/**
 * Description of CalendrierAdmin
 *
 * @author joel
 */
class CalendrierMoniteur extends AbstractCalendrier{
    
    
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
                if($resa['etatReservation']=="Fermer"){
                    echo ("<input type='checkbox' value='".$date."'>Fermer");
                }
                echo ("<input type='checkbox' value='".$date.">".$this->userProprietaire->getNom());                
                $estDispo=false;
            }         
        }
        if($estDispo){
            echo ("<input type='checkbox' value='".$date."'>Dispo");
        }          
    }

}
