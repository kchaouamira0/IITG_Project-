<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TypePost;
use FM\ElfinderBundle\Form\Type\ElFinderType;

class PostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('title')
                ->add('titleFr')
                ->add('description')
                ->add('descriptionFr')
                ->add('content', CKEditorType::class)
                ->add('contentFr', CKEditorType::class)
                ->add('typePost', EntityType::class,
                        [
                            'class' => TypePost::class,
                            'placeholder' => 'Choose an type'
                        ]
                )
                ->add('imagePoster', ElFinderType::class ,['instance' => 'form', 'enable' => true])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }

}
