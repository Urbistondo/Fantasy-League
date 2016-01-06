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
            ->add('user', null, array('label' => 'Usuario', 'attr' => array('oninvalid' => 'setCustomValidity("Tienes que introducir un nombre de usuario")', 'oninput' => 'setCustomValidity("")')))
            ->add('comment', null, array('label' => 'Comentario', 'attr' => array('oninvalid' => 'setCustomValidity("Tienes que introducir un comentario")', 'oninput' => 'setCustomValidity("")')))
            /**->add('approved')
            *->add('created')
            *->add('updated')
            ->add('post')
            */
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BlogBundle\Entity\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blogger_blogbundle_comment';
    }
}
