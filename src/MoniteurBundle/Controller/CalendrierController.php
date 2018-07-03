<?php

namespace MoniteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CalendrierController
 *
 * @author frup73532
 */
class CalendrierController extends Controller {

    public function calendrierAction() {
        $userService = $this->get('user_service');
        $clients = $userService->getAllUsersMoniteur($this->getUser()->getId());
        $reservations = array();
        foreach ($clients as $client) {                        
            $lesResas=$userService->getReservations($client['id']);
            foreach ($lesResas as $resa) { 
                array_push($reservations, $resa );
            }                        
        }
        return $this->render('MoniteurBundle:Calendrier:calendrier.html.twig', array('clients' => $clients, 'reservations' => $reservations));
    }

}
