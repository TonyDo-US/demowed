<?php

namespace App\Form;

use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Teacher Name',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('date', DateType::class,
            [
                'label' => 'Teaher DOB',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('phone', IntegerType::class,
            [
                'label' => 'Teacher phone',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('address', TextType::class,
            [
                'label' => 'Teacher address',
                'required' => true,
                'attr' => [
                    'maxlength' => 30,
                    'minlength' => 5
                ]
            ])
            ->add('email', TextType::class,
            [
                'label' => 'Teacher email',
                'required' => true,
                'attr' => [
                    'maxlength' => 100,
                    'minlength' => 5
                ]
            ])
            ->add('image', TextType::class,
            [
                'label' => 'Teacher image',
                'required' => true,
            ])
            ->add('gender', ChoiceType::class,
            [
                'label' => 'Teacher gender',
                'required' => true,
                'choices' => [
                    'male' => 'male',
                    'female' => 'female'
                ]
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
} 
