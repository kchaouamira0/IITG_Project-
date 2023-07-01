<?php

namespace App\Form;

use App\Entity\Direction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\PhoneType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\EmailForType;
use FM\ElfinderBundle\Form\Type\ElFinderType;

class DirectionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('firstName')
                ->add('lastName')
                ->add('address')
                ->add('sign', ElFinderType::class, [
                    'instance' => 'direction',
                    'enable' => true,
                    ])
                ->add('imageProfile', ElFinderType::class, [
                    'instance' => 'direction',
                    'enable' => true,
])
                ->add('emails', CollectionType::class, [
                    'entry_type' => EmailForType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_options' => ['label' => false],
                    'label' => false
                ])
                ->add('phones', CollectionType::class, [
                    'entry_type' => PhoneType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_options' => ['label' => false],
                    'label' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Direction::class,
        ]);
    }

}
