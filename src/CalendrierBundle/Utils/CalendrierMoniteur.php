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
    private $moniteur;
    
    function __construct($reservations,$moniteur,$users) {
        parent::__construct($reservations,$moniteur);
        $this->users = $users;
    }
    
    
    public function display() {      
        $this->headCalendrier();
        $this->corpCalendrier();        
    }

    public function afficheCase($date) {        
        $estDispo=true;        
        foreach ($this->reservations as $resa) {            
            $heureResa = $resa['dateDebut']; 
            if($date==$heureResa){
                $estDispo=false;
                if($resa['etat']=="Fermer"){                    
                    echo ("<td class='fermer'><p>Bloqué</p><input type='checkbox' class='fermer' value='".$date."'> </td>");
                    break;
                }elseif($resa['etat']=="Réserver"){                    
                    echo ("<td class='reserver'>" . '<p class=reserver>' . $this->getNomReserveur($this->users, $resa['client_id']) . "</p> <input type='checkbox' class='reserver' value='".$date."'>". '</td>');
                    break;
                }elseif($resa['etat']=="Valider"){                    
                    echo ("<td class='valider'>" . '<p class=valider>'.$this->getNomReserveur($this->users, $resa['client_id'])."</p> <input type='checkbox' class='valider' value='".$date."'>".'</td>');
                    break;
                }
            }         
        }
        if($estDispo){
            echo ("<td><p>Libre</p><label class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-check ui-state-checked'></label> <input type='checkbox'  class='ui-checkboxradio' value='".$date."'></td>");
        }          
    }
	
	public function formatName($name){		
		if(strlen($name) > 6){
			$res= strtolower(substr($name,0,6)) . ".";
			return ucfirst($res);
		}else{
			return ucfirst(strtolower($name));
		}
	}
    
    public function getNomReserveur($users,$idClient){        
        foreach ($users as $user) {                         
            if($user['id']===$idClient){                
                return $this->formatName($user['nom']);
            }
        }
    }

}
