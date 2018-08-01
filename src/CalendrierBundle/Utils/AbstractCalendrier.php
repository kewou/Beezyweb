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

    function __construct($reservations) {
        $this->reservations = $reservations;
        $this->dateCourante = new DateTime();
        $this->tabHeure = array('8h', '9h', '10h', '11h', '14h', '15h', '16h', '17h');
        $this->tabJour = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
        $this->tabMois = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    }

    abstract function display();
    
    public function caseEstDispo($heure,$reservations){        
        foreach ($reservations as $resa) {
            echo $heure;            
            $heureResa = $this->getHeureFromStringDate($resa['dateReservation'])."h";
            echo $heureResa;
            return $heure==$heureResa;
        }        
    }
    
    public function getHeureFromStringDate($dateString){
        return(explode(":",explode(" ",$dateString)[1])[0]);
    }
    
    public function headCalendrier(){
        $this->dateCourante;   
        echo ($this->tabMois[$this->dateCourante->format('n')] ." ".date("Y"));
        // Le calendrier
        echo ("<table border='1'>");
        echo ("<tr>\n<th></th>\n");
        for($indiceJour=0 ; $indiceJour<count($this->tabJour); $indiceJour++) {
            if($this->dateCourante->format('w')=="0"){               
                $this->dateCourante->add(new DateInterval('P1D'));
                continue; 
            }
            echo ("<th class='jourFirstLine'>".$this->tabJour[$this->dateCourante->format('w')]." ".intval($this->dateCourante->format('d'))."</th>\n");	
            $this->dateCourante->add(new DateInterval('P1D'));           
        }
    }
    
    public function paginationCalendrier(){
        echo ("<ul  class='pagination' id='pagerCalendrier'>
            <li class='page-item'><a class='page-link' href='#' onclick='tab(-7)' aria-label='Previous'>
                    <span aria-hidden='true'>&laquo; Précédent</span></a>
            </li>
                        <li class='page-item'><a class='page-link' href='#' onclick='tab(7)' aria-label='Next'>
                    <span aria-hidden='true'>Suivant &raquo;</span></a>
            </li>
         </ul>");
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