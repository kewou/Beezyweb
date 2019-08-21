<?php


namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    
    public function infosClientByNomAction(){
        $request = Request::createFromGlobals();
        $nomClient = $request->request->get('nom');
        $userService = $this->get('user_service');
        $client = $userService->getUserByName($nomClient);
        return $this->render('AdminBundle:GestionClient:unClient.html.twig',array('user' => $client));
    }
    
    public function removeJetonAction(){
        $request = Request::createFromGlobals();
        $nomClient = $request->request->get('nom');
        $userService = $this->get('user_service');        
        $client=$userService->removeJeton($nomClient);        
        return $this->render('AdminBundle:GestionClient:unClient.html.twig',array('user' => $client));
        
    }    
    
    public function addJetonAction(){
        $request = Request::createFromGlobals();
        $nomClient = $request->request->get('nom');
        $userService = $this->get('user_service');
        $client=$userService->addJeton($nomClient); 
        return $this->render('AdminBundle:GestionClient:unClient.html.twig',array('user' => $client));
        
    }
    
    public function deleteUserAction($id){
        $userService = $this->get('user_service');
        $userService->deleteUser($id);
        $clients = $userService->getAllUsers();
        return $this->render('AdminBundle:GestionClient:clients.html.twig',array('clients' => $clients));
    }
}
