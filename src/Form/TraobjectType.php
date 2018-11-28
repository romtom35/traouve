<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\County;
use App\Entity\State;
use App\Entity\Traobject;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TraobjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('picture', FileType::class, ['label' => 'Image', 'required' => false])
            ->add('category', EntityType::class, ['class' => Category::class, 'placeholder' => 'Choisissez une catégorie', 'label' => 'Catégories : '])
            ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false])
            ->add('eventAt', DateTimeType::class, ['label' => 'Date de l\'évènement : '])
            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('city', TextType::class, ['label' => 'Ville'])
            ->add('county', EntityType::class, ['class' => County::class, 'placeholder' => 'Choisissez un département', 'label' => 'Département : '])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Traobject::class,
        ]);
    }
}
