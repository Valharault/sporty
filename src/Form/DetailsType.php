<?php

namespace App\Form;

use App\Entity\Details;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville', TextType::class, array('label' => '', 'attr' => array('class' => 'form-control', 'placeholder' => 'Ville de résidence')))
            ->add('codepostal', TextType::class, array('label' => '', 'attr' => array('class' => 'form-control', 'max' => '99999', 'placeholder' => 'Code Postal')))
            ->add('telephone', NumberType::class, array('label' => '', 'attr' => array('class' => 'form-control', 'placeholder' => 'Numéro de téléphone')))
            ->add('bio', TextareaType::class, array('label' => '', 'attr' => array('class' => 'form-control', 'rows' => '6', 'placeholder' => 'Bio')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Details::class,
        ]);
    }
}
