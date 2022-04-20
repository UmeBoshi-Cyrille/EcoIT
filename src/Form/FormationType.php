<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Category;
use App\Entity\User;
use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', TextType::class, [
            'label' => 'Formation title'
        ])
        ->add('sentence', TextType::class)
        ->add('description', TextareaType::class)
        ->add('category', EntityType::class, [
            'class' => Category::class,
            'choice_label' => 'title'
        ])
        ->add('instructor', EntityType::class, [
            'class' => User::class,
            'choice_label' => function (User $instructor) {
                return $instructor->getName() . ' ' . $instructor->getSurname();
            },    
        ])
        ->add('publishedAt', DateType::class, [
            'widget' => 'single_text'
        ])
        ->add('isPublished')
        ->add('sections', CollectionType::class, [
            'label' => false,
            'entry_type' => SectionType::class,
            'entry_options' => [
                'label' => false
            ],
            'allow_add' => true,
            'allow_delete' => true,
            'prototype' => true,
            'prototype_name' => '_sec_',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
