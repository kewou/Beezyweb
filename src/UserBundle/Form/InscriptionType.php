<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Description of InscriptionType
 *
 * @author noumia
 */
class InscriptionType extends AbstractType{
   
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //parent::buildForm($builder,$options);
        
        $builder
            ->add('nom','text',array('label'=>'Nom','pattern'=>'.{3,}','max_length'=>'15'))
            ->add('prenom','text',array('label'=>'Prénom','pattern'=>'.{3,}','max_length'=>'15'))
            ->add('telephone','number',array('label'=>'Téléphone','pattern'=>'[0-9]*','max_length'=>'9'))                                                                                           
            ->add('email','text', array('label' => 'Adresse email', 'translation_domain' => 'FOSUserBundle'))                                                   
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',            	
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Mot de passe (mdp)','pattern'=>'.{5,}'),
                'second_options' => array('label' => 'Confirmation mdp','pattern'=>'.{5,}'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))                  
            //->add('captcha','genemu_captcha',array('mapped'=>false));
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'autoecole_inscription';
    }  
    
    public function getParent()
 
   {
       return 'FOS\UserBundle\Form\Type\RegistrationFormType';
   }
}
