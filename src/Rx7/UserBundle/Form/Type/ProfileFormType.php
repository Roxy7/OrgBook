<?php

namespace Rx7\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

    
        $builder->add('roles', 'collection',
                    array('label' => 'Roles',
                    	  'type' => 'choice',
                    		'required'  => false,
                    	  'options' => array( 'choices' => array('ROLE_USER' => 'Vide',
                    	  										 'ROLE_AUTEUR' => 'Auteur',
                    	  										 'ROLE_MODERATEUR' => 'Moderateur',
                            		 							 'ROLE_ADMIN' => 'Admin',
                    	  										 'ROLE_SUPER_ADMIN' => 'super Admin') 
                    	  					)
           		
                    	  )
        		      );
        

        
    }

    public function getName()
    {
        return 'rx7_userbundle_profile';
    }
}