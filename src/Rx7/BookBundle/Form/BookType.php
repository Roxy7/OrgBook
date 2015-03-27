<?php

namespace Rx7\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Rx7\BookBundle\Form\ImageType;
use Rx7\BookBundle\Entity\Category;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('purchaseDate', 	'datetime')
            ->add('title',       	'text')
            ->add('text',     	'textarea')
            ->add('bookRead', 	'checkbox', array('required' => false))
            ->add('cover',		new ImageType(), array('required' => false))
            ->add('author',		'entity', array(
            		'class' => 'Rx7BookBundle:Author',
            		'property' => 'fullName',
            		'multiple' => false)
            		)
            ->add('categories',		'entity', array(
            		'class' => 'Rx7BookBundle:Category',
            		'property' => 'name',
            		'multiple' => true)
            )
            ->add('shelf', 'entity', array(
            		'class' => 'Rx7BookshelfBundle:Shelf',
            		'property' => 'id',
            		'multiple' => false
            ))
        ;
            // On récupère la factory (usine)
            $factory = $builder->getFormFactory();
            
            // On ajoute une fonction qui va écouter l'évènement PRE_SET_DATA
            $builder->addEventListener(
            		FormEvents::PRE_SET_DATA, // Ici, on définit l'évènement qui nous intéresse
            		function(FormEvent $event) use ($factory) { // Ici, on définit une fonction qui sera exécutée lors de l'évènement
            			$book = $event->getData();
            			// Cette condition est importante, on en reparle plus loin
            			if (null === $book) {
            				return; // On sort de la fonction lorsque $article vaut null
            			}
            		}
            );
            
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Rx7\BookBundle\Entity\Book'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rx7_bookbundle_book';
    }
}
