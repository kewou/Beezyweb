<?php

namespace CalendrierBundle\Utils;

use DateInterval;

/**
 * Description of CalendrierPrivee
 *
 * @author joel
 */
class CalendrierPrivee extends AbstractCalendrier{
    
    private $userProprietaire;
    

    function __construct($reservations,$userProprietaire) {
        parent::__construct($reservations); 
        $this->userProprietaire = $userProprietaire;
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
                break;
            }         
        }
        if($estDispo){
            echo ("<input type='checkbox' value='".$date."'>Dispo");                                                
        }        
    }
    
    public function getUserProprio(){
        return $this->userProprietaire;
    }

}
