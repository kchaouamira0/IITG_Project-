<?php

namespace App\Form;

use App\Entity\OpenPreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OpenPreInscriptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('academicYear')
                ->add('title')
                ->add('description')
                ->add('current')
                ->add('dateStart', DateType::class, [
                    'widget' => 'single_text',
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control datePicker',
                    ]
                ])
                ->add('dateEnd', DateType::class, [
                    'widget' => 'single_text',
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control datePicker',
                    ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => OpenPreInscription::class,
        ]);
    }

}
