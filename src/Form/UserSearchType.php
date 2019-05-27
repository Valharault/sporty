<?php

namespace App\Form;

use App\Entity\Sport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departement',TextType::class, [
                'required' => false,
                'label' => 'Département recherché',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer le code postal de la ville recherché'
                ]
            ])
            ->add('sports', EntityType::class, [
                'class' => Sport::class,
                'multiple' => false,
                'expanded' => false,
                'choice_label' => 'nom',
                'label' => 'Sport recherché',
                'placeholder' => 'Selectionner un sport',
                'label' => 'Sport recherché',
                'attr' => [
                    'class' => 'form-control',
                ],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
