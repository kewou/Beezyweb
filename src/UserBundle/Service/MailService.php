<?php

namespace UserBundle\Service;


/**
 * Envoi de mail
 *
 * @author frup73532
 */
class MailService {
    
    private $mailer;
    
    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;        
    }
    
    public function sendMail($from,$to,$body,$subject){
        $message = ( new \Swift_Message())
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)    
            ->setBody($body);
        
        $this->mailer->send($message);
    }
    

}
