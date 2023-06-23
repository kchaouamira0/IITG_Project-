<?php

namespace App\Form;

use App\Entity\PreInscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PreInscription1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('anneeUniv')
            ->add('firstName')
            ->add('lastName')
            ->add('birthdate')
            ->add('placeOfBirth')
            ->add('email')
            ->add('adress')
            ->add('phone')
            ->add('etab')
            ->add('bac')
            ->add('sector')
            ->add('isAccepted')
            ->add('createdAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PreInscription::class,
        ]);
    }
}
