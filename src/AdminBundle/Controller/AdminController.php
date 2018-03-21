<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


/**
 * Description of AdminController
 *
 * @author noumia
*/
class AdminController extends Controller{
	
	
	
	const PRIX_HEURE_CONDUITE =36.5;
    
    function indexAction(){
        return $this->render("AdminBundle:Admin:index.html.twig");                                                                                                                                                   
    }
   
    function codeAction(){
        return $this->render("AdminBundle:Admin:code.html.twig");
    }
        
    function permisAction(){
        return $this->render("AdminBundle:Admin:permis.html.twig");
    }
        
    function tarifsAction(){
        return $this->render("AdminBundle:Admin:tarifs.html.twig");
    }
        
        
    function retrouverAction(){
        return $this->render("AdminBundle:Admin:retrouver.html.twig");
    }
    function adminListeClientAction(){
    	$securityContext = $this->container->get('security.context');
    	if (!$securityContext->isGranted('ROLE_ADMIN')) {
    		return die("Fonction réservée à l'administrateur");
    	}    	 
    	$em=$this->getDoctrine()->getManager();
    	$repo= $em->getRepository('UtilisateurBundle:Utilisateur');
    	$listeClient = $repo->getAllUserName();
    	$em->flush();
    	$encoders = array(new XmlEncoder(), new JsonEncoder());
    	$normalizers = array(new GetSetMethodNormalizer());    
    	$serializer = new Serializer($normalizers, $encoders);
    	$serializer->serialize($listeClient, 'json');
    	$response = new JsonResponse();
    	$response->setData($listeClient);
    
    	return $response;
    }
    
    function ajouterArgentAction(){
    	$securityContext = $this->container->get('security.context');
    	if (!$securityContext->isGranted('ROLE_ADMIN')) {
    		return die("Fonction réservée à l'administrateur");
    	}else{
	    	$request = Request::createFromGlobals();
	    	$em=$this->getDoctrine()->getManager();
	    	$repo= $em->getRepository('UtilisateurBundle:Utilisateur');
	    	$somme= $request->request->get('somme');	    	
	    	$id= $request->request->get('id'); 	    	   	    	
	    	$client=$repo->findOneById($id);	    	
	    	$valArgent=$client->getMoney()+$somme;
	    	$res= fmod($valArgent,self::PRIX_HEURE_CONDUITE);
	    	$valHeure = (int)($valArgent /self::PRIX_HEURE_CONDUITE );	    	 
	    	$client->setMoney($res);
	    	$client->setSolde($client->getSolde()+$valHeure);
	    	$em->flush();
	    	$tableClient[]=$client; 
	    	$lesResa=$repo->getAllReservationDate($client->getNom());
	    	$tableClient[1]=$lesResa;
        	return $this->render("AdminBundle:Admin:infosClient.html.twig",array('variables'=>$tableClient));
    	}
    }
    
    function infosClientAction(){
    	$securityContext = $this->container->get('security.context');
    	if (!$securityContext->isGranted('ROLE_ADMIN')) {
    		return die("Fonction réservée à l'administrateur");
    	}else{
	        $request = Request::createFromGlobals();
	        $name= $request->request->get('nomClient');                                
	        $em=$this->getDoctrine()->getManager();
	        $repo= $em->getRepository('UtilisateurBundle:Utilisateur'); 
	        $lesResa=$repo->getAllReservationDate($name);
	        $client=$repo->findOneByNom($name);        
	        $tableClient[0]=$client;
	        $tableClient[1]=$lesResa;
	        return $this->render("AdminBundle:Admin:infosClient.html.twig",array('variables'=>$tableClient));
    	}
    }

    function clientsAction(){
        return $this->render("AdminBundle:Admin:clients.html.twig");
    }
    



}
