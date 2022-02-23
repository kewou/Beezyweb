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
            ->add('nom','text',array('label'=>' ','pattern'=>'.{2,}','max_length'=>'15'))
            ->add('prenom','text',array('label'=>' ','pattern'=>'.{2,}','max_length'=>'15'))
            ->add('email','email',array('label'=>' '))
            ->add('telephone','number',array('label'=>' '))
            ->add('entreprise','choice',array('label'=>'Choix de l\'auto-école',
                'choices' => array('Campus'=>'Campus','Auto-Ecole Grande Delle'=>'Auto-Ecole Grande Delle'),
                                   'multiple' => false,'preferred_choices' => array('Slimeur Coiffure')
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',            	                
                'first_options' => array('label' => ' ','max_length'=>'20'),
                'second_options' => array('label' => ' '),'max_length'=>'20',
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
