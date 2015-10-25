<?php

namespace Automatiz\ApiBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', 'text')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function OptionsResolver(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\Step',
            'csrf_protection' => false
        ));
    }

    public function setDefaultOptions(
        \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
    ) {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\Step',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'step';
    }
}