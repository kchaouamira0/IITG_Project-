<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;
    

class ContactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
                ->add('name')
                ->add('email', EmailType::class)
                ->add('subject')
                ->add('message', TextareaType::class)
                ->add('termsAccepted', CheckboxType::class, array(
                     'label' => 'Terms accepted',
                    'mapped' => false,
                    'constraints' => new IsTrue(),
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}
