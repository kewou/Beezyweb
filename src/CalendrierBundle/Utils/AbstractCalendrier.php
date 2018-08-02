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
    protected $userProprietaire;

    function __construct($reservations,$userProprietaire) {        
        $this->reservations = $reservations;
        $this->userProprietaire = $userProprietaire;
        $this->dateCourante = new DateTime();
        $this->tabHeure = array('08h', '09h', '10h', '11h', '14h', '15h', '16h', '17h');
        $this->tabJour = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
        $this->tabMois = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    }

    abstract function display();
    
    abstract function afficheCase($date); 

    
    
    /*
    public function getHeureFromStringDate($dateString){
        return(explode(":",explode(" ",$dateString)[1])[0]);
    }
    */
    
    public function headCalendrier(){
        $dateTemp = clone $this->dateCourante;           
        echo ($this->tabMois[$dateTemp->format('n')] ." ".date("Y"));
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
                echo("<td>");
                // date Case
                $dateCase=$dateTemp->format('Y-m-d ' .substr($heure, 0, -1).':00:00');
                $this->afficheCase($dateCase);
                echo("</td>");
                $dateTemp->add(new DateInterval('P1D'));                
            }
            
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
    
    function getUserProprio(){
        return $this->userProprietaire;
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