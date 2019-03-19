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
                    echo ("<td class='fermer'><input type='checkbox' class='fermer' value='".$date."'> <p>Bloqué</p></td>");
                    break;
                }elseif($resa['etatReservation']=="Réserver"){                    
                    echo ("<td class='reserver'><input type='checkbox' class='reserver' value='".$date."'>".'<p class=reserver>' . strtoupper($this->getNomReserveur($this->users, $resa['client_id'])) .'</p></td>');
                    break;
                }elseif($resa['etatReservation']=="Valider"){                    
                    echo ("<td class='valider'><input type='checkbox' class='valider' value='".$date."'>".'<p class=valider>'.strtoupper($this->getNomReserveur($this->users, $resa['client_id'])).'</p></td>');
                    break;
                }
            }         
        }
        if($estDispo){
            echo ("<td><label class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-check ui-state-checked'></label> <input type='checkbox'  class='ui-checkboxradio' value='".$date."'>Libre</td>");
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
