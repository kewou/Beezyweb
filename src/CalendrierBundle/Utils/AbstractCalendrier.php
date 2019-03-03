<?php

namespace CalendrierBundle\Utils;

use DateInterval;
use DateTime;

/**
 * Description of Calendrier
 *
 * @author joel
 */
abstract class AbstractCalendrier {

    protected $dateCourante;
    protected $tabHeure;
    protected $tabJour;
    protected $tabMois;
    protected $reservations;   
    
    function __contruct(){
        
    }

    function __construct($reservations) {        
        $this->reservations = $reservations;        
        $this->dateCourante = new DateTime();
        $this->tabHeure = array('08h', '09h', '10h', '11h', '14h', '15h', '16h', '17h');
        $this->tabJour = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
        $this->tabMois = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    }

    abstract function display();
    
    abstract function afficheCase($date); 

    
    
    
    public function headCalendrier(){
        $dateTemp = clone $this->dateCourante;           
        echo ("<p id=titreCalendrier>".$this->tabMois[$dateTemp->format('n')] ." ".date("Y")."</p>");        
        // Le calendrier
        echo ("<table border='1'>");
        echo ("<tr>\n<th></th>\n");
        for($indiceJour=0 ; $indiceJour<count($this->tabJour); $indiceJour++) {
            if($dateTemp->format('w')=="0"){               
                $dateTemp->add(new DateInterval('P1D'));
                continue; 
            }
            echo ("<th class='jourFirstLine'>".$this->tabJour[$dateTemp->format('w')]." ".intval($dateTemp->format('d'))."</th>\n");	
            $dateTemp->add(new DateInterval('P1D'));           
        }
        echo ("</tr>");
    }
    
    public function corpCalendrier(){                               
        foreach ($this->tabHeure as $heure){
            echo("<tr>\n<th class='trHeure'>".$heure."</th>\n");
            $dateTemp = clone $this->dateCourante;
            foreach ($this->tabJour as $jour) {                
                if($dateTemp->format('w')=="0"){                     
                    $dateTemp->add(new DateInterval('P1D'));
                    continue; 
                }                                                 
                // date Case
                $dateCase=$dateTemp->format('Y-m-d ' .substr($heure, 0, -1).':00:00');
                $this->afficheCase($dateCase);                
                $dateTemp->add(new DateInterval('P1D'));                
            }
        echo ("</tr>\n");   
        }        
        echo ("</table>");        
    }
    

    function getDateCourante() {
        return $this->dateCourante;
    }

    function getTabHeure() {
        return $this->tabHeure;
    }

    function getTabJour() {
        return $this->tabJour;
    }

    function getTabMois() {
        return $this->tabMois;
    }    
    function getReservations() {
        return $this->reservations;
    }

    function setDateCourante($dateCourante) {
        $this->dateCourante = $dateCourante;
    }

    function setTabHeure($tabHeure) {
        $this->tabHeure = $tabHeure;
    }

    function setTabJour($tabJour) {
        $this->tabJour = $tabJour;
    }

    function setTabMois($tabMois) {
        $this->tabMois = $tabMois;
    }

    function setReservations($reservations) {
        $this->reservations = $reservations;
    }

}

?>