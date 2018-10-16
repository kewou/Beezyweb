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
        echo("Calendrier Privée " . "<br>");
        $this->headCalendrier();
        $this->corpCalendrier();        
    }

    public function afficheCase($date) {
        $estDispo=true;        
        foreach ($this->reservations as $resa) {                    
            $heureResa = $resa['dateReservation']; 
            if($date==$heureResa){
                $estDispo=false;
                if(($this->getUserProprio()->getId()==$resa['client_id'])){
                    echo "<input type='checkbox' value='".$date."'>".$this->userProprietaire->getNom();
                }elseif($resa['etatReservation']=="Fermer"){                    
                    echo "Fermer";
                    break;
                }else{
                    echo "Réservée";
                    break;
                }                                
            }         
        }
        if($estDispo){
            echo ("<input type='checkbox' value='".$date."' class='libre'>Libre");                                                
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
