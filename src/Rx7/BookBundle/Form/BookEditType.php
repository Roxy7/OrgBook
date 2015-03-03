<?php

namespace Rx7\BookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Rx7\BookBundle\Form\ImageType;
use Rx7\BookBundle\Entity\Category;

class BookEditType extends BookType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('purchaseDate');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'rx7_bookbundle_bookedittype';
    }
}
