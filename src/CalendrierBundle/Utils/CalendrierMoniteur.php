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
                    echo ("<input type='checkbox' class='fermer' value='".$date."'>Bloqué");
                    break;
                }elseif($resa['etatReservation']=="Réserver"){                    
                    echo ("<input type='checkbox' class='reserver' value='".$date."'>".$this->getNomReserveur($this->users, $resa['client_id'])); 
                    break;
                }elseif($resa['etatReservation']=="Valider"){                    
                    echo ("<input type='checkbox' class='valider' value='".$date."'>".$this->getNomReserveur($this->users, $resa['client_id'])); 
                    break;
                }
            }         
        }
        if($estDispo){
            echo ("<label class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-check ui-state-checked'></label> <input type='checkbox'  class='ui-checkboxradio' value='".$date."'>Libre");
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
