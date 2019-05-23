<?php

namespace PriveeBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;



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
    
    public function formatDateInFrench($date){
        $nom_jour_fr = array("Dimanche", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam");
        $mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
                "septembre", "octobre", "novembre", "décembre");
        // on extrait la date du jour
        list($nom_jour, $jour, $mois, $annee) = explode('/', date_format($date,("w/d/n/Y")));        

        return $nom_jour_fr[$nom_jour].' '. $this->enleveZero($jour).' '.$mois_fr[$mois] . ' '.
                $this->enleveZero(date_format($date,('H'))) .'h';        
    }
    
    public function enleveZero($chaine){
        if($chaine[0]=="0"){
            $chaine=substr($chaine,1);
        }
        return $chaine;
    }
}
