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
            ->add('nom','text',array('label'=>'Nom','pattern'=>'.{2,}','max_length'=>'15'))
            ->add('prenom','text',array('label'=>'Prénom','pattern'=>'.{2,}','max_length'=>'15'))
            ->add('telephone','number',array('label'=>'Téléphone','max_length'=>'10'));			
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
