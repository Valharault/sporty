<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('label' => 'Pseudo', 'attr' => array('class' => 'form-control')))
            ->add('nom', TextType::class, array('label' => 'Nom', 'attr' => array('class' => 'form-control')))
            ->add('prenom', TextType::class, array('label' => 'Prenom', 'attr' => array('class' => 'form-control')))
            ->add('email', EmailType::class, array('label' => 'Email', 'attr' => array('class' => 'form-control')))
            ->add('age', IntegerType::class, array('label' => 'Age', 'attr' => array('class' => "form-control", 'min' => '0', 'max' => '99')))
            ->add('password', PasswordType::class, array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control',)))
            ->add('confirm_password', PasswordType::class, array('label' => 'Comfirmation du mot de passe', 'attr' => array('class' => 'form-control')))
            ->add('sexe', ChoiceType::class, array(
                'choices' => array(
                    'Homme' => 'homme',
                    'Femme' => 'femme',
                ),
                'multiple' => false,
                'expanded' => true,
                'attr' => array(
                    'class' => 'custom-control-input',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
