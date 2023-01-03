<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle',TextType::class,[
                'label'=> 'Nom article',
                'constraints' => new Length(['min'=>2,'max'=>30]),
                'attr' =>[
                    'placeholder' =>'Entez un nom pour votre article '
                ]
            ])
            ->add('isDisponible', CheckboxType::class, [
                'label'    => 'cet article est-il disponible ?',
                'required' => false,
            ])
            ->add('price', MoneyType::class, [
                'divisor' => 100,
            ])
            ->add('marque',TextType::class,[
                'label'=> 'Marque',
                'constraints' => new Length(['min'=>2,'max'=>30]),
                'attr' =>[
                    'placeholder' =>'Entez une marque pour votre article '
                ]
            ])
            ->add('categorie',EntityType::class, [
                'label' => 'choisissez votre Categorie',
                'required' => true,
                'class' =>Categorie::class,
                'multiple' => false,
                
                                        ])

            ->add('image', FileType::class,[
                'mapped'=>false,
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
