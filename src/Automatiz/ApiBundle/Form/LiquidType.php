<?php

namespace Automatiz\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LiquidType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add("is_alcoohol", "bool")
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function OptionsResolver(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\Liquid',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cocktail';
    }
}
