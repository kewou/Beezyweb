<?php

namespace PriveeBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use DateTime;
use DateInterval;



/**
 * Description of BeezyExtension
 *
 * @author frup73532
 */
class BeezyExtension extends AbstractExtension{

    public function getFunctions()  {  
        return array(
            new TwigFunction('formatPhone', array($this, 'formatNumberPhone')),
            new TwigFunction('firstLetter', array($this, 'firstLetterOfChaine')),
            new TwigFunction('fortmatDate', array($this, 'formatDateInFrench')),
	    new TwigFunction('triTableauDate', array($this ,'sortReservations')),			
        );
    }
    
    
    public function firstLetterOfChaine($chaine){  
        return $chaine[0];
    }

    public function formatNumberPhone($phone){
        $number=str_split(strval($phone));            
        return $number[0]." ".$number[1].$number[2]." ".$number[3].$number[4]
              ." ".$number[5].$number[6]." ".$number[7].$number[8];
    }
    
    public function formatDateInFrench($resa){
        $nom_jour_fr = array("Dimanche", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam");
        $mois_fr = Array("", "janv.", "févr.", "mars", "avril", "mai", "juin", "juill.", "août", 
                "sept.", "octo.", "novem.", "décem.");
        // on extrait la date du jour
        list($nom_jour, $jour, $mois, $annee) = explode('/', date_format($resa->getDateDebut(),("w/d/n/Y")));        
        if($resa->getClient()->getEntreprise()->getId()==2){
            return $nom_jour_fr[$nom_jour].' '. $this->enleveZero($jour).' '.$mois_fr[$mois] . ' : '.
                    $this->enleveZero(date_format($resa->getDateDebut(),('H')))
                    .'h'
                    .date_format($resa->getDateDebut(),('i')) 
                    .'- '
                    . $this->enleveZero(date_format($resa->getDateFin(),('H')))
                    .'h'
                    .date_format($resa->getDateFin(),('i')); 
        }else{
            if($resa->getTypeCoiffure()=="Complexe"){
                $newDateFin = clone $resa->getDateFin();
                $newDateFin->add(new DateInterval('PT30M'));
                $resa->setDateFin($newDateFin);
                
                return $nom_jour_fr[$nom_jour].' '. $this->enleveZero($jour).' '.$mois_fr[$mois] . ' : '.
                        $this->enleveZero(date_format($resa->getDateDebut(),('H')))
                        .'h'
                        .date_format($resa->getDateDebut(),('i')) 
                        .'- '
                        . $this->enleveZero(date_format($resa->getDateFin(),('H')))
                        .'h'
                        .date_format($resa->getDateFin(),('i'));
            }else if($resa->getTypeCoiffure()=="Simple"){
                return $nom_jour_fr[$nom_jour].' '. $this->enleveZero($jour).' '.$mois_fr[$mois] . ' : '.
                        $this->enleveZero(date_format($resa->getDateDebut(),('H')))
                        .'h'
                        .date_format($resa->getDateDebut(),('i')) 
                        .'- '
                        . $this->enleveZero(date_format($resa->getDateFin(),('H')))
                        .'h'
                        .date_format($resa->getDateFin(),('i'));
            }else{
                return "";
            }
            
        }
    }
    
    public function enleveZero($chaine){
        if($chaine[0]=="0"){
            $chaine=substr($chaine,1);
        }
        return $chaine;
    }

	
    public function sortReservations($tabResa){
        foreach($tabResa as $key => $resa){			
                if($resa->getEtat()=="Fermer" or $resa->getDateDebut() < new DateTime('now')){				
                        unset($tabResa[$key]);
                }			
        }
        return $tabResa;
    }
	

	

	
}
