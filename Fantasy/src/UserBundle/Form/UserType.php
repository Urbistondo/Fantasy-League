<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'Username', 'attr' => array('oninvalid' => 'setCustomValidity("You must introduce a username (1-30 characters)")', 'oninput' => 'setCustomValidity("")')))
            ->add('password', null, array('label' => 'Password', 'attr' => array('oninvalid' => 'setCustomValidity("You must introduce a password (1-30 characters)")', 'oninput' => 'setCustomValidity("")')))
            ->add('name', null, array('label' => 'Name', 'attr' => array('oninvalid' => 'setCustomValidity("You must introduce a name (1-30 characters)")', 'oninput' => 'setCustomValidity("")')))
            ->add('email', null, array('label' => 'Email', 'attr' => array('oninvalid' => 'setCustomValidity("You must introduce a email (1-50 characters)")', 'oninput' => 'setCustomValidity("")')))
            ->add('points', null, array('label' => 'Points'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}