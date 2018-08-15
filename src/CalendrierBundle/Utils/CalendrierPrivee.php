<?php

namespace CalendrierBundle\Utils;

use DateInterval;

/**
 * Description of CalendrierPrivee
 *
 * @author joel
 */
class CalendrierPrivee extends AbstractCalendrier{
    

    function __construct($reservations,$userProprietaire) {
        parent::__construct($reservations,$userProprietaire);        
    }
    
    
    public function display() {
        echo("Calendrier Privée " . "<br>");
        $this->headCalendrier();
        $this->corpCalendrier();        
    }

    public function afficheCase($date) {
        $estDispo=true;        
        foreach ($this->reservations as $resa) {                    
            $heureResa = $resa['dateReservation']; 
            if($date==$heureResa){                 
                if(($this->getUserProprio()->getId()==$resa['client_id'])){
                    echo $this->userProprietaire->getNom();
                }else{
                    echo "Réservée";
                }
                $estDispo=false;
            }         
        }
        if($estDispo){
            echo "<label class='container'>One
                    <input type='checkbox' value=".$date.">Dispo
                    <span class='checkmark'></span>
                  </label>"
            ;
        }        
    }

}
