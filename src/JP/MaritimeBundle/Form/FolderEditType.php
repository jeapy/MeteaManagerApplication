<?php

namespace JP\MaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FolderEditType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('owner',EntityType::class, array(
                      'class'        => 'JPUserBundle:Users',
                      'choice_label' => 'username',
                      'multiple'     => false,                    
                      'placeholder' => 'Choisir un utilisateur',
                      'required' => true
                    ))
                
                ;

    }
    
    public function getParent()
  {
    return FolderType::class;

  }


}
