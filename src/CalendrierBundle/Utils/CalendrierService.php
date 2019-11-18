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
        $this->datePivot=new Datetime();
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
}
