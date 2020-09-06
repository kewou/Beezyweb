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
            return $this->render("PriveeBundle:Privee:index.html.twig",array('user' => $this->getUser()));           
        }else{ 
            return $this->render("PublicBundle:Public:index.html.twig" );
        }

    }
   
    function contactAction(){
        return $this->render("PublicBundle:Public:contact.html.twig");
    }
    
    function Public_mentionLegaleAction(){
       return $this->render("PublicBundle:Public:mentionLegale.html.twig"); 
    }
   
    function mailContactAction(){              
        $request = Request::createFromGlobals();      
        $subject= $request->request->get('sujet'); 
        $from= $request->request->get('email');
        $message=$request->request->get('message');
		$userService = $this->get('mail_service');
		$userService->receiveMessageContact($subject,$message,$from);
        return $this->render("PublicBundle:Public:sendMailOk.html.twig" );

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





