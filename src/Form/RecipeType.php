<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Difficulty;
use App\Entity\Recipe;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'label' => 'Titre',
                'attr' =>[
                    'placeholder' => 'Titre'
                ]
            ])
            ->add('bakingTime')
            ->add('preparationTime')
            ->add('nbPersonne')
            ->add('pictureFile', FileType::class, [
                //oui je sais que pictureFile n'existe pas dans l'entité dc pas mappé. on fera le lien dans notre code
                'mapped' => false
            ])
            ->add('difficulty')
            ->add('category', EntityType::class,[
        'class' => Category::class,
        'choice_label' => 'label'
    ])
            ->add('tags', EntityType::class,[
                'class' => Tag::class,
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
