<?php

namespace CalendrierBundle\Utils;

use DateTime;
use DateInterval;

/**
 * Description of CalendrierService
 *
 * @author joel
 */
class CalendrierService {
    
    private $datePivot;    

    function __construct() {
        $this->datePivot=$this->genereDatePivot();
    }
    
    function addSevenDay(){
        $this->datePivot->add(new DateInterval('P7D'));
    }
    
    function getDatePivot(){
        return $this->datePivot;
    }
    function setDatePivot($datePivot){
        $this->datePivot=$datePivot;
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
}
