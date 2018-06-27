<?php


namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of GestionClientController
 *
 * @author frup73532
 */
class GestionClientController extends Controller{
    
    public function clientsAction() {
        $userService = $this->get('user_service');
        $clients = $userService->getAllUsers();
        return $this->render('AdminBundle:GestionClient:clients.html.twig',array('clients' => $clients));
    }
}
