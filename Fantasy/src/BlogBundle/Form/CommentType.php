<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', null, array('label' => 'User', 'attr' => array('oninvalid' => 'setCustomValidity("You must enter a username")', 'oninput' => 'setCustomValidity("")')))
            ->add('comment', null, array('label' => 'Comment', 'attr' => array('oninvalid' => 'setCustomValidity("You must enter a comment")', 'oninput' => 'setCustomValidity("")')))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolve)
    {
        $resolve->setDefaults(array('data_class' => 'BlogBundle\Entity\Comment'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogger_blogbundle_comment';
    }
}
