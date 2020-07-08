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
    
    function __contruct(){
        
    }

    function __construct($reservations,$userProprietaire) {        
        $this->reservations = $reservations;        
        $this->dateCourante = $this->genereDatePivot();
        $this->userProprietaire = $userProprietaire;        
        $this->tabHeure = $this->getTabHeure($userProprietaire->getEntreprise()->getTypePlageHoraire());        
        $this->tabJour = array('Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam');
        $this->tabMois = array("", "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
    }

    abstract function display();
    
    abstract function afficheCase($date);
    
    public function getTabHeure($typePlageHoraire){
        if($typePlageHoraire == 1){
            return array('08h','09h','10h','11h', '12h', '13h', '14h', '15h','16h','17h','18h','19h');
        }else if($typePlageHoraire == 2){
            return array('11h','11h30', '12h','12h30','13h','13h30','14h','14h30','15h','15h30','16h','16h30','17h','17h30','18h','18h30');
        }
    }

    
    
    
    public function headCalendrier(){
        $dateTemp = clone $this->dateCourante;
		$numeroToday = date("d");
        echo ("<p id=titreCalendrier>".$this->tabMois[$dateTemp->format('n')] ." ".$dateTemp->format('Y')."</p>");       
        // Le calendrier
        echo ("<table border='1'>");
        echo ("<tr>\n<th></th>\n");
        for($indiceJour=0 ; $indiceJour<count($this->tabJour); $indiceJour++) {
            if($dateTemp->format('w')=="0"){               
                $dateTemp->add(new DateInterval('P1D'));
                continue;
            }
			if($numeroToday===$dateTemp->format('d')){			
				echo ("<th class='jourFirstLine today'>".$this->tabJour[$dateTemp->format('w')]." ".intval($dateTemp->format('d'))."</th>\n");	
				$dateTemp->add(new DateInterval('P1D'));
			}else{
				echo ("<th class='jourFirstLine'>".$this->tabJour[$dateTemp->format('w')]." ".intval($dateTemp->format('d'))."</th>\n");
				$dateTemp->add(new DateInterval('P1D'));
			}
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
                $dateCase=$dateTemp->format('Y-m-d ' .$this->getDateCase($heure));
                $this->afficheCase($dateCase);                
                $dateTemp->add(new DateInterval('P1D'));                
            }
        echo ("</tr>\n");   
        }        
        echo ("</table>");        
    }
	
	function genereDatePivot(){ 
		// Le debut de la semaine est Lundi
		$dateDuJour=new DateTime();
		if($dateDuJour->format('w')!=="0"){
			$dateUpdate=clone $dateDuJour;
			// valeur à modifier pour obtenir le lundi
			$x=intval($dateDuJour->format('w'))-1;		
			$dateUpdate->sub(new DateInterval('P'.$x.'D'));
		}
		return $dateUpdate;
	}
    
    function getDateCase($heure){        
        $ch=explode('h',$heure);        
        if(strlen($heure)==3){
            return $ch[0].':00:00';
        }else{
            // heure avec 30 min
            return $ch[0].":".$ch[1].":00";
        }
        
    }
    

    function getDateCourante() {
        return $this->dateCourante;
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