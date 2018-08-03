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
        
    }

    public function afficheCase($date) {
        $estDispo=true;        
        foreach ($this->reservations as $resa) {                    
            $heureResa = $resa['dateReservation']; 
            if($date==$heureResa){                                 
                echo $this->userProprietaire->getNom();                
                $estDispo=false;
            }         
        }
        if($estDispo){
            echo "Dispo";
        }          
    }

}
