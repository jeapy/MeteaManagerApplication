<?php

namespace JP\MaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AffectationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('etape', ChoiceType::class, array(
                        'choices'  => array(
                            'Expertise' => 'expertise',
                            'Redaction' => 'redaction',
                            'Correction' => 'correction',
                        ),
                        'placeholder' =>'Choisir une étape'
                    ))                
                ->add('user',EntityType::class, array(
                      'class'        => 'JPUserBundle:Users',
                      'choice_label' => 'username',
                      'group_by' => 'roles[0]',
                      
                      
                      'multiple'     => false,                    
                      'placeholder'  => 'Choisir un utilisateur',
                      'required'     => true
                    ))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JP\MaritimeBundle\Entity\Affectation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jp_maritimebundle_affectation';
    }


}
