<?php

namespace Rx7\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BookType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('purchaseDate', 	'date')
            ->add('title',       	'text')
            ->add('text',     	'textarea')
            ->add('bookRead', 	'checkbox', array('required' => false))
            /*->add('cover')
            ->add('author')
            ->add('categories')*/
        ;
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
