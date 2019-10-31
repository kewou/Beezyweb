<?php


namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    
    public function infosClientByNomAction(Request $request){        
        $nomClient = $request->request->get('nom');
        $userService = $this->get('user_service');		        
        $client = $userService->getUserByName($nomClient);
        return $this->render('AdminBundle:GestionClient:unClient.html.twig',array('user' => $client));
    }
	
	public function infosClientByNomAdminAction(Request $request){        
        $nomClient = $request->request->get('nom');
        $userService = $this->get('user_service');
		$moniteurs = $userService->getAllMoniteurs($this->getUser()->getEntreprise()->getId());
        $user = $userService->getUserByName($nomClient);
        return $this->render('AdminBundle:GestionClient:unClientAdmin.html.twig',array('user' => $user,'moniteurs' => $moniteurs));			
    }
	
	public function addArgentAction(Request $request){        
        $nomClient = $request->request->get('nom');
	    $sommeArgent = $request->request->get('somme');
        $userService = $this->get('user_service');
		$moniteurs = $userService->getAllMoniteurs($this->getUser()->getEntreprise()->getId());
        $client=$userService->addArgent($nomClient,intval($sommeArgent));		
        return $this->render('AdminBundle:GestionClient:unClientAdmin.html.twig',array('user' => $client,'moniteurs' => $moniteurs));
        
    }
    
    public function removeArgentAction(Request $request){        
        $nomClient = $request->request->get('nom');
		$sommeArgent = $request->request->get('somme');		
        $userService = $this->get('user_service');
		$moniteurs = $userService->getAllMoniteurs($this->getUser()->getEntreprise()->getId());		
        $client=$userService->removeArgent($nomClient,intval($sommeArgent));        
        return $this->render('AdminBundle:GestionClient:unClientAdmin.html.twig',array('user' => $client,'moniteurs' => $moniteurs));
        
    }    
       
    public function deleteUserAction($id){
        $userService = $this->get('user_service');
        $userService->deleteUser($id);
        $clients = $userService->getAllUsers();
        return $this->render('AdminBundle:GestionClient:clients.html.twig',array('clients' => $clients));
    }
	
	public function switchMoniteurAction(Request $request){
		$idMoniteur=$request->request->get('idMoniteur');
		$idUser=$request->request->get('idUser');
		$userService = $this->get('user_service');
		$moniteur=$userService->getUser($idMoniteur);
		$client=$userService->getUser($idUser);
		$userService->switchMoniteur($client,$moniteur);
		$moniteurs = $userService->getAllMoniteurs($this->getUser()->getEntreprise()->getId());
		return $this->render('AdminBundle:GestionClient:unClientAdmin.html.twig',array('user' => $client,'moniteurs' => $moniteurs));
	}
	
	// Liste tous les clients
	function rechercheClientAction(Request $request){
        $nomClient=$request->query->get('term');         	
        $tabUserDTO=array();
        $userService = $this->get('user_service'); 
        $users=$userService->getAllUsersByFiltre($nomClient);        
        
        foreach($users as $user){			
			array_push($tabUserDTO,$userService->getUserDTO($user));			
        }        
        return new JsonResponse($tabUserDTO);
	}
}
