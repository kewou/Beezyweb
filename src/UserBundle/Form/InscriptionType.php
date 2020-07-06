<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
        $builder
            ->add('nom','text',array('label'=>'Nom','pattern'=>'.{2,}','max_length'=>'15'))
            ->add('prenom','text',array('label'=>'Prénom','pattern'=>'.{2,}','max_length'=>'15'))
            ->add('telephone','number',array('label'=>'Téléphone','max_length'=>'10'))
            ->add('entreprise','choice',array('label'=>'Choix de l établissement',
                'choices' => array('Auto-Ecole Grande Delle'=>'Auto-Ecole Grande Delle','Marco Coiffure'=>'Marco Coiffure'),
                                   'multiple' => false,'preferred_choices' => array('Auto-Ecole Grande Delle')
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',            	                
                'first_options' => array('label' => 'Mot de passe (mdp)','max_length'=>'20'),
                'second_options' => array('label' => 'Confirmation mdp'),'max_length'=>'20',
                'invalid_message' => 'fos_user.password.mismatch',
            ));
        $builder->remove('username');
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
