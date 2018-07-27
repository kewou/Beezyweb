<?php

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Description of CalendrierExtension
 *
 * @author frup73532
 */
class CalendrierExtension extends AbstractExtension {
    
    public function getFilters(){
        return array(
            new TwigFilter('price', array($this, 'priceFilter')),
        );
    }
    
}
