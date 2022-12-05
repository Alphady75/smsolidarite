<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compte', ChoiceType::class, [
                'label' => false,
                'choices'  => [
                    'Particulier' =>  'particulier',
                    'Entreprise'    =>  'entreprise',
                ],
                'attr' => ['class' => 'type__select'],
                'expanded' => true,
                'multiple' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide!',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Prénom*'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide',
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Nom*'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Email*'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut pas être vide',
                    ]),
                    new Email([
                        'message' => 'Cette valeur ne correspond pas à une adresse email valide',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Mot de passe*'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Ce champ ne peut pas être vide',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot de passe doit faire en minimum {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => false,
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Confirmer votre Mot de passe*'],
                    'label' => 'Confirmer votre Mot de passe*',
                ],
                'invalid_message' => 'Les deux mots de passes ne correspondent pas.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => "J'accepte les termes et conditions d'utilisation",
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez nos termes et contrat d\'utilisation',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
