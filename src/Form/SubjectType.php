<?php

namespace App\Form;

use App\Entity\Subject;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', ChoiceType::class,[
            'choices' => [
                'BI' => 'BI',
                'Programming' => 'Programming',
                'Database' => 'Database',
                'Cloud Compurting' => 'Cloud Compurting'
            ],
        ])
           
            ->add('subjectNo')
            ->add('subjectSlots', IntegerType::class, [
                'attr'=>[
                    'max'=> 200,
                    'min' => 20
                ]
            ])
            ->add('ok', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}
