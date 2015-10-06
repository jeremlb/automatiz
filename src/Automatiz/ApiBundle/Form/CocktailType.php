<?php

namespace Automatiz\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CocktailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('alcoohol')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('note')
            ->add('description')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\Cocktail'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'automatiz_apibundle_cocktail';
    }
}
