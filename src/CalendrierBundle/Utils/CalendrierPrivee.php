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
    private static $cal=null;

    function __construct($reservations,$userProprietaire) {
        parent::__construct($reservations); 
        $this->userProprietaire = $userProprietaire;
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
                if($resa['etatReservation']=="Réserver"){
                    if($this->getUserProprio()->getId()==$resa['client_id']){
                        echo "<td class='reserver'><p class='reserver'>".$this->userProprietaire->getNom()."<p></td>";
                        break;
                    }else{
                        echo "<td class='indispo'>Réservé</td>";
                        break;
                    } 
                }
                elseif($resa['etatReservation']=="Valider"){                    
                    if($this->getUserProprio()->getId()==$resa['client_id']){
                        echo "<td class='valider'><p class='valider'>".$this->userProprietaire->getNom()."<p></td>";
                        break;
                    }else{
                        echo "<td class='indispo'><p>Réservé</p></td>";
                        break;
                    }                    
                }elseif($resa['etatReservation']=="Fermer"){                    
                    echo "<td class='fermer'><p class='Fermer'>Fermé<p></td>";
                    break;
                }                               
            }         
        }
        if($estDispo){
            echo ("<td class='checkCase'><input type='checkbox' value='".$date."' class='libre'/><p>Libre</p></td>");                                                
        }        
    }
    
    public function getUserProprio(){
        return $this->userProprietaire;
    }
    
    public static function getInstance($reservations,$userProprietaire) { 
        if(is_null(self::$cal)) {
          self::$cal = new CalendrierPrivee($reservations,$userProprietaire);  
        } 
        return self::$cal;
    }    

}
