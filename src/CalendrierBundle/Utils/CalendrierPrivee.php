<?php

namespace CalendrierBundle\Utils;

use DateInterval;

/**
 * Description of CalendrierPrivee
 *
 * @author joel
 */
class CalendrierPrivee extends AbstractCalendrier{
    

    function __construct($reservations) {
        parent::__construct($reservations);        
    }
    
    
    public function display() {
        echo("Calendrier Privée " . "<br>");
        $this->headCalendrier();
        $this->corpCalendrier();
        echo ("</tr>\n");
        echo ("</table>");
        $this->paginationCalendrier();

    }
    
    private function corpCalendrier(){
        $resas=$this->reservations;
        foreach ($this->tabHeure as $heure){
            echo("<tr>\n<th class='trHeure'>".$heure."</th>\n");
            foreach ($this->tabJour as $jour) {
                if($this->dateCourante->format('w')=="0"){               
                    $this->dateCourante->add(new DateInterval('P1D'));
                    continue; 
                }
                echo("<td>");
                if($this->caseEstDispo($heure,$resas)){
                    echo("elie");
                    $this->dateCourante->add(new DateInterval('P1D'));
                }else{
                    echo "assita";
                    $this->dateCourante->add(new DateInterval('P1D'));
                }
            }
        }
    }
    
    
    



}
