<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=> 'First Name',
                'constraints' => new Length(['min'=>2,'max'=>30]),
                'attr' =>[
                    'placeholder' =>'Please enter your first name '
                ]
            ])
            ->add('lastname',TextType::class,[
                'label'=> 'Last Name',
                'constraints' => new Length(['min'=>2,'max'=>30]),
                'attr' =>[
                    'placeholder' =>'Please enter your last name'
                ]
            ])
            ->add('email', EmailType::class,[
                'label'=>'Email Address',
                'constraints' => new Length(['min'=>9,'max'=>60]),
                'attr' => [
                    'placeholder' => 'Please Enter your email'
                ]

            ])
            ->add('password', RepeatedType::class,[
                'type' =>passwordType::class,
                'invalid_message' =>'Passwords does not match please try again.',
                
                'required' => true,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' => [
                        'placeholder' => 'Please enter your password' 
                    ]
                    ],
                'second_options' => [
                    'label' => 'Repeat Password',
                    'attr' => [
                        'placeholder' => 'Please confirm your password' 
                    ]],
            ])
           
            ->add('submit', SubmitType::class,[
                'label'=>'Register',
                
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
