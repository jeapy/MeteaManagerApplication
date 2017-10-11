<?php

namespace JP\MaritimeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class FolderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
              
                ->add('ftype', ChoiceType::class, array(
                        'choices'  => array(
                            'Maritime' => 'MA',
                            'Terrestre' => 'T',
                            'Aérien' => 'A',
                            'Ferrovière' => 'F',
                        ),
                        'expanded' =>true))
                ->add('requerant')
                ->add('moyentp')
                ->add('dateArrive')
                ->add('description')
                ->add('dateIntervention')
                ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JP\MaritimeBundle\Entity\Folder'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jp_maritimebundle_folder';
    }


}
