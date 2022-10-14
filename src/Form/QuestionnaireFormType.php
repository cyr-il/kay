<?php

namespace App\Form;

use App\Entity\Questionnaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class QuestionnaireFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('screens')
            ->add('xliff')
            ->add('json')
            ->add('spec')
            ->add('version')
            ->add('author')
            ->add('device', ChoiceType::class, array(
                'choices'=>array(
                    'SM-T225'=>'SM-T225',
                    'SM-T295'=>'SM-T295',
                    'SM-T515'=>'SM-T515',
                    'SM-T505'=>'SM-T505',
                    'SM-X205'=>'SM-X205',
                    'Xcover 4S'=>'Xcover 4S'
                )
            ))
            ->add('isreviewed', ChoiceType::class, array(
                'label'=>'Is the questionnaire reviewed ?',
                'choices'=>array(
                    'Reviewed'=>'Reviewed',
                    'Draft'=>'Draft',
                    'In progress'=>'In progress'
                )
            ))
            ->add('brochure', FileType::class, [
                'label' => 'Screenshots (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ]
                    ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionnaire::class,
        ]);
    }
}