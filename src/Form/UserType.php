<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, ['help' => 'Enter your login'])
            ->add('email', TextType::class, ['help' => 'We will never give your personal data to tiers.'])
            ->add('passwrd', PasswordType::class, ['help' => '8 caracters minimum', 'label' => 'Password'])
            ->add('avatar', FileType::class, ['help' => 'Help the other user to trust you.',
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
                            ]
                            )]
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
            'data_class' => Users::class,
        ]);
    }
}
