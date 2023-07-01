<?php

namespace App\Form;

use App\Entity\Institut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Form\EmailForType;
class InstitutType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('adress')
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
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Institut::class,
        ]);
    }

}
