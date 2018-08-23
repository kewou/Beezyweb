<?php

namespace ReservationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ReservationBundle\Entity\Reservation;
use CalendrierBundle\Utils\CalendrierPrivee;
use DateTime;


/**
 * Description of ReservationController
 *
 * @author joel
 */
class ReservationController extends Controller{
    
    
    
    
    function reserverAction(){        
        $request = Request::createFromGlobals();
        $tabDate = $request->request->get('lesResaChoisi');        
        $securityContext = $this->container->get('security.context');
        if (!$securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {           
            return die('Veuillez vous identifiez svp !');
        }
        $entityManager = $this->getDoctrine()->getManager();
        foreach ($tabDate as $dateString){            
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);            
            $resa = new Reservation();
            $resa->setClient($this->getUser());
            $resa->setEtatReservation("Réserver");
            $resa->setDateReservation($dateTime);
            $entityManager->persist($resa);
            $entityManager->flush();
        }        
        $user = $this->getUser();
        $userService = $this->get('user_service');                       
        $reservations = $userService->getAllReservationsFromClient($user->getId());
        $cal = new CalendrierPrivee($reservations,$user);        
        return new Response($cal->display());                
    }
}
