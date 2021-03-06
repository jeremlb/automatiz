<?php

namespace Automatiz\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('description', 'text')
            ->add('steps', 'collection', array('type' => new StepType(),
                'allow_add' => true,
                'by_reference' => false
            ))
        ;
    }

    
    /**
     * @param OptionsResolver $resolver
     */
    public function OptionsResolver(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\Cocktail',
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
