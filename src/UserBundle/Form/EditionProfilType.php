<?php

namespace UserBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType;

/**
 * Description of EditionProfilType
 *
 * @author noumia
 */
class EditionProfilType extends ProfileFormType{
   
    
      /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder,$options);
         $builder
             ->add('nom','text')
             ->add('prenom','text')
             ->add('telephone','number',array('label'=>'Téléphone','pattern'=>'[0-9]*','max_length'=>'9'));
			
    }
    
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {

    }
    
     /**
     * @return string
     */
    public function getName()
    {
        return 'autoecole_edition_profil';
    }   
}
