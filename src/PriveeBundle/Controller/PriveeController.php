<?php

namespace PriveeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of PriveeController
 *
 * @author noumia
 */
class PriveeController  extends Controller{
    
    function indexAction(){
        return $this->render("PriveeBundle:Privee:index.html.twig");                                                                                                                                                   
    }
	
	function mailAction(){
		$request = Request::createFromGlobals();
		$user=$this->getUser();
		$nom=$user->getPrenom()." ".$user->getNom();
        $sujet= $request->request->get('sujet'); 
		$fromEmail= $user->getEmail();
		$contenu=$request->request->get('message');	
	   		
		$to= 'beezyweb.net@beezyweb.net';
		$subject = $sujet;
		$message = $contenu;
		$headers = 'From: ' .$nom. "\r\n" .
	   'Reply-To:' .$fromEmail. "\r\n" .
	   'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message,$headers);
		
		return $this->render("PriveeBundle:Privee:index.html.twig" );
	}	
   
    function codeAction(){
        return $this->render("PriveeBundle:Privee:code.html.twig");
    }
        
    function permisAction(){
        return $this->render("PriveeBundle:Privee:permis.html.twig");
    }
        
    function tarifsAction(){
        return $this->render("PriveeBundle:Privee:tarifs.html.twig");
    }
        
    function nouveauxAction(){
        return $this->render("PriveeBundle:Privee:nouveaux.html.twig");
    }
        
    function retrouverAction(){
        return $this->render("PriveeBundle:Privee:retrouver.html.twig");
    }
    
            

}
