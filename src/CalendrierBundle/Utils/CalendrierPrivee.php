<?php

namespace CalendrierBundle\Utils;

use DateInterval;

/**
 * Description of CalendrierPrivee
 *
 * @author joel
 */
class CalendrierPrivee extends AbstractCalendrier{
    

    function __construct($reservations,$userProprietaire) {
        parent::__construct($reservations,$userProprietaire);        
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
        $dateTemp = clone $this->dateCourante;        
        foreach ($this->tabHeure as $heure){
            echo("<tr>\n<th class='trHeure'>".$heure."</th>\n");
            foreach ($this->tabJour as $jour) {                                 
                if($dateTemp->format('w')=="0"){                     
                    $dateTemp->add(new DateInterval('P1D'));
                    continue; 
                }                                 
                echo("<td>");
                // date Case
                $dateCase=$dateTemp->format('Y-m-d ' .substr($heure, 0, -1).':00:00');
                $this->afficheCase($dateCase);
                $dateTemp->add(new DateInterval('P1D'));                
                                
            }                        
        }
    }
    
    
    



}
