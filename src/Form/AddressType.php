<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label' =>'what name would you like to give to your address ?',
                'attr'=>[
                    'placeholder'=>'name your address'
                ]
            ])
            ->add('firstname',TextType::class,[
                'label' =>'Your first name',
                'attr'=>[
                    'placeholder'=>'Enter your first name'
                ]
            ])
            ->add('lastname',TextType::class,[
                'label' =>'Your last name',
                'attr'=>[
                    'placeholder'=>'Enter your last name'
                ]
            ])
            ->add('company',TextType::class,[
                'label' =>'Your company',
                'required' => false,
                'attr'=>[
                    'placeholder'=>'(optional) Enter the name of your company'
                ]
            ])
            ->add('address',TextType::class,[
                'label' =>'Your address',
                'attr'=>[
                    'placeholder'=>'2327 Clinton Street ...'
                ]
            ])
            ->add('postal',TextType::class,[
                'label' =>'Your postal code ',
                'attr'=>[
                    'placeholder'=>'Enter your postal code'
                ]
            ])
            ->add('city',TextType::class,[
                'label' =>'Your city',
                'attr'=>[
                    'placeholder'=>'Enter your city'
                ]
            ])
            ->add('country',CountryType::class,[
                'label' =>'Country',
                'attr'=>[
                    'placeholder'=>'Your country'
                ]
            ])
            ->add('phone',TelType::class,[
                'label' =>'Your phone',
                'attr'=>[
                    'placeholder'=>'Enter your phone'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label' => 'Confirm',
                'attr' => [
                    'class'=> 'btn-block btn-info '
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
