<?php


namespace PublicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of PublicController
 *
 * @author noumia
 */
class PublicController extends Controller {        
    
    function PublicController(){
        $this->securityContext = $this->container->get('security.context');
    }
   
    function indexAction(){        
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {            
            return $this->render("PriveeBundle:Privee:index.html.twig" );
            
        }else{ 
        	/*$message= \Swift_Message::newInstance()
        		->setSubject("test")        		
        		->setTo("beezyweb.net@beezyweb.net")
        		->setBody("Message test 2");
        	$this->get('mailer')->send($message);
        	*/
            return $this->render("PublicBundle:Public:index.html.twig" );
        }
    }
    
    function contactAction(){
        return $this->render("PublicBundle:Public:contact.html.twig");
    }
	
    function mailAction(){
            $request = Request::createFromGlobals();
            $nom=$request->request->get('nom');
    $subject= $request->request->get('sujet'); 
            $fromEmail= $request->request->get('email');
            $body=$request->request->get('message');		   			
            $to= 'beezyweb.net@beezyweb.net';
            $headers = 'From: ' .$nom. "\r\n" .
       'Reply-To:' .$fromEmail. "\r\n" .
       'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $body,$headers);

            return $this->render("PublicBundle:Public:index.html.twig" );
    }
    
    function codeAction(){
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {            
            return $this->render("PriveeBundle:Privee:code.html.twig" );            
        }else{
            return $this->render("PublicBundle:Public:code.html.twig");
        }
    }
        
    function permisAction(){
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {            
            return $this->render("PriveeBundle:Privee:permis.html.twig" );            
        }else{
            return $this->render("PublicBundle:Public:permis.html.twig");
        }
    }
        
    function tarifsAction(){
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {            
            return $this->render("PriveeBundle:Privee:tarifs.html.twig" );            
        }else{
            return $this->render("PublicBundle:Public:tarifs.html.twig");
        }
    }
        
    function nouveauxAction(){
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {            
            return $this->render("PriveeBundle:Privee:nouveaux.html.twig" );            
        }else{
            return $this->render("PublicBundle:Public:nouveaux.html.twig");
        }
    }
        
    function retrouverAction(){
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {            
            return $this->render("PriveeBundle:Privee:retrouver.html.twig" );            
        }else{
            return $this->render("PublicBundle:Public:retrouver.html.twig");
        }
    }
    
    static function isPair($nbre){
        return $nbre % 2 == 0;
    }
    
    

}


