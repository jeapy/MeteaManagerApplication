<?php

namespace JP\FinanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class FactureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('numfacture',TextType::class,array(

                     'attr'        => array('class'=>'form-control')
                  ))

                ->add('boncommande',TextType::class,array(

                     'attr'        => array('class'=>'form-control')
                  ))
                
                ->add('tva',ChoiceType::class, array(
                      'label' => 'Appliquez la TVA ?', 
                      'choices'     => array(
                                    'Oui' => "1",
                                    'Non' => "0",
                                    
                                ),                                                     
                      'placeholder' => 'TVA ?',
                      'required'    => true,
                      'attr'        => array('class'=>'form-control')
                    ))

                ->add('totalfacture',TextType::class,array(

                     'attr'        => array('class'=>'form-control')
                  ))

                ->add('facture_item', CollectionType::class, array(
                        'entry_type'   => Facture_itemType::class,
                        'allow_add'    => true,
                        'allow_delete' => true,
                        'by_reference' => false,  
                        'required' => true,            

                      ))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'JP\FinanceBundle\Entity\Facture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jp_financebundle_facture';
    }


}
