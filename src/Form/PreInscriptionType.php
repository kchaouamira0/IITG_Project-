<?php

namespace App\Form;

use App\Entity\PreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Speciality;
use App\Repository\SpecialityRepository;

class PreInscriptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('firstName')
                ->add('lastName')
                ->add('birthdate', DateType::class, [
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    // prevents rendering it as type="date", to avoid HTML5 date pickers
                    'html5' => false,
                    // adds a class that can be selected in JavaScript
                    'attr' => ['class' => 'js-datepicker'],
                ])
                ->add('placeOfBirth')
                ->add('email')
                ->add('adress')
                ->add('phone')
                ->add('etab')
                ->add('bac', ChoiceType::class, [
                    'placeholder' => 'Choose an option',
                    'choices' => [
                        'A1' => 'A1',
                        'A2' => 'A2',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E',
                    ],
                ])
                ->add('speciality', EntityType::class, [
                    'class' => Speciality::class,
                    'expanded' => false,
                    'query_builder' => function (SpecialityRepository $er) {
                        return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC');
                    },
                    'group_by' => function (Speciality $speciality) {
                        return $speciality->getFiliereByParcours();
                    },
                    'attr' => [
                        'class' => 'speciality-tags'
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => PreInscription::class,
        ]);
    }

}
