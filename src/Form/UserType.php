<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array                $options
    ): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 20
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 60
                ]
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 100
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Phone',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'maxlength' => 12
                ]
            ])
            ->add('isEmailSubscribed', ChoiceType::class, [
                'label' => 'Email Subscription',
                'required' => true,
                'attr' => [
                    'class' => 'form-control mt-1 mb-2'
                ],
                'choices' => [
                    'No' => 0,
                    'Yes' => 1
                ],
            ])
            ->add('isSmsSubscribed', ChoiceType::class, [
                'label' => 'SMS Subscription?',
                'required' => true,
                'attr' => [
                    'class' => 'form-control mt-1 mb-2'
                ],
                'choices' => [
                    'No' => 0,
                    'Yes' => 1
                ],
            ]);

        $builder->add('save', SubmitType::class, [
            'label' => 'Save',
            'attr' => [
                'class' => 'btn btn-primary'
            ]
        ]);
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\User'
        ]);
    }
}
