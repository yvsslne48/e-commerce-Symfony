<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label'       => 'Full Name',
                'attr'        => ['placeholder' => 'Enter your full name'],
                'constraints' => [
                    new NotBlank(['message' => 'Le nom est requis.']),
                    new Length(['min' => 2, 'max' => 20]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label'       => 'Email address',
                'attr'        => ['placeholder' => 'Enter your email'],
                'constraints' => [
                    new NotBlank(['message' => "L'email est requis."]),
                ],
            ])
            ->add('phone', TextType::class, [
                'label'    => 'Phone Number',
                'required' => false,
                'attr'     => ['placeholder' => 'ex: +212 762762846'],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'            => PasswordType::class,
                'mapped'          => false,
                'first_options'   => [
                    'label' => 'Password',
                    'attr'  => ['placeholder' => 'Create a password'],
                ],
                'second_options'  => [
                    'label' => 'Confirm Password',
                    'attr'  => ['placeholder' => 'Confirm your password'],
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'constraints'     => [
                    new NotBlank(['message' => 'Le mot de passe est requis.']),
                    new Length([
                        'min'        => 6,
                        'minMessage' => 'Le mot de passe doit contenir au moins {{ limit }} caractères.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
