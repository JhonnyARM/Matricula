<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /* ->add('nombre', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El campo nombre es requerido.']),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'El nombre debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El nombre no debe superar los {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('apellidoPaterno', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El campo apellido paterno es requerido.']),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'El apellido paterno debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El apellido paterno no debe superar los {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('apellidoMaterno', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El campo apellido materno es requerido.']),
                    new Length([
                        'min' => 2,
                        'max' => 255,
                        'minMessage' => 'El apellido materno debe tener al menos {{ limit }} caracteres.',
                        'maxMessage' => 'El apellido materno no debe superar los {{ limit }} caracteres.',
                    ]),
                ],
            ])
            ->add('dni', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'El campo DNI es requerido.']),
                    new Length([
                        'min' => 8,
                        'max' => 8,
                        'exactMessage' => 'El DNI debe tener exactamente {{ limit }} dígitos.',
                    ]),
                ],
            ]) */
            // INFO DE VALIDACION
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
