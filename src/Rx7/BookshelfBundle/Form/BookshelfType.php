<?php

namespace Rx7\BookshelfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;


class BookshelfType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
		->add('name',			'text')
		->add('localisation', 	'text')
        ->add('position',       'text')
		;
		// On récupère la factory (usine)
		$factory = $builder->getFormFactory();
	
		// On ajoute une fonction qui va écouter l'évènement PRE_SET_DATA
		$builder->addEventListener(
				FormEvents::PRE_SET_DATA, // Ici, on définit l'évènement qui nous intéresse
				function(FormEvent $event) use ($factory) { // Ici, on définit une fonction qui sera exécutée lors de l'évènement
					$bookshelf = $event->getData();
					// Cette condition est importante, on en reparle plus loin
					if (null === $bookshelf) {
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
				'data_class' => 'Rx7\BookshelfBundle\Entity\Bookshelf'
		));
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'rx7_bookshelfbundle_bookshelf';
	}
}