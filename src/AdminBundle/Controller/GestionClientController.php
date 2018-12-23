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
        $user=$this->getUser();
        $userService = $this->get('user_service');
        $clients = $userService->getAllUsers();
        return $this->render('AdminBundle:GestionClient:clients.html.twig',array('clients' => $clients,'user' => $user));
    }
        
    public function infosClientAction($id){
        $userService = $this->get('user_service');
        $client = $userService->getUser($id);
        return $this->render('AdminBundle:GestionClient:compteClient.html.twig',array('client' => $client));        
    }
    
    public function updateSolde($solde){
        
    }
    
    public function deleteUserAction($id){
        $userService = $this->get('user_service');
        $userService->deleteUser($id);
        $clients = $userService->getAllUsers();
        return $this->render('AdminBundle:GestionClient:clients.html.twig',array('clients' => $clients));
    }
}
