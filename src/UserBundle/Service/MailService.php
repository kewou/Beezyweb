<?php

namespace UserBundle\Service;


/**
 * Envoi de mail
 *
 * @author frup73532
 */
class MailService {
    
    //private $mailer;
    
	/*
    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;        
    }*/
    
    public function receiveMessageContact($subject,$message,$from){
		$headers = 'From:' . $from  . "\r\n" .
		'Reply-To: ' . $from . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
        mail('beezyweb.net@beezyweb.net', $subject, $message, $headers);                
    }
    

}
