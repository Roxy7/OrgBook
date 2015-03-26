<?php

namespace Rx7\BookshelfBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class BookshelfEditType extends BookshelfType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rx7_bookbundle_bookshelfedittype';
    }
}
