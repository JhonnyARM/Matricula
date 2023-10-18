<?php

namespace App\Form;

use App\Entity\Alumno;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistroAlumnoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, [
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
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alumno::class,
        ]);
    }
}
