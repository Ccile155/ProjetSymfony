<?php

namespace App\Form;

use App\Entity\Annonces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,
                ['help' => 'Un titre explicite pour qu\'un acheteur trouve votre annonce !',
                 'label'=> 'Titre de l\'annonce'])
            ->add('prix', MoneyType::class, 
                ['help' => 'Prix en €uros.'])
            ->add('description', TextareaType::class, 
                ['help' => 'Détails de l\'offre, restez clair et concis.'])
            ->add('photo', FileType::class, 
                ['help' => 'Les annonces avec photos sont consultées 70% plus souvent.',
                 'mapped' => false,
                 'required' => false,
                 'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/gif',
                            'image/jpeg',
                            'image/png',
                            ],
                        'mimeTypesMessage' => 'Please upload a valid Image file',
                        ])
                ],
            ])
            ->add('submit', SubmitType::class, 
                ['label' => 'Send',
                'attr' => [
                    'class' => 'btn btn-success'
                    ]
                ])
            ;
        }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
