<?php

namespace App\Form;

use App\Entity\Formation;
use App\Entity\Category;
use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('sentence')
            ->add('description')
            ->add('author')
            ->add('publishedAt')
            ->add('isPublished')
            ->add('category', EntityType::class, [
                'class' => Category::class
            ])
        ;

        $builder
            ->add('section', CollectionType::class, [
                'entry_type' => SectionType::class,
                'entry_options' => ['label' => false],
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
