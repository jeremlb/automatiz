<?php
/**
 * Created by PhpStorm.
 * User: jeremi
 * Date: 11/11/2015
 * Time: 19:56
 */

namespace Automatiz\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file')
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function OptionsResolver(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\CocktailImage',
            'csrf_protection' => false
        ));
    }

    public function setDefaultOptions(
        \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
    ) {
        $resolver->setDefaults(array(
            'data_class' => 'Automatiz\ApiBundle\Entity\CocktailImage',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cocktail_image';
    }
}