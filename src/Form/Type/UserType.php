<?php

namespace projet4\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints as Assert;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username', TextType::class, array(
                    'label'       => "Nom utilisateur",
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
                ))
                ->add('password', RepeatedType::class, array(
                    'type'            => PasswordType::class,
                    'constraints'     => new Assert\Length(['min' => 6]),
                    'invalid_message' => 'Les mots de passes doivent correspondre.',
                    'options'         => array(
                        'required' => true
                    ),
                    'first_options'   => array(
                        'label'       => 'Mot de passe',
                        'required'    => true,
                        'attr'        => ['placeholder' => 'Minimum 6 caractères'],
                    ),
                    'second_options'  => array(
                        'label'       => 'Répéter le mot de passe',
                        'attr'        => ['placeholder' => 'Le même mot de passe'],
                        'required'    => true,
                    ),
                ))
                ->add('email', EmailType::class, array(
                    'constraints' => new Assert\Email() 
                ))
                ->add('role', ChoiceType::class, array(
                    'choices' => array(
                        'Admin' => 'ROLE_ADMIN',
                        'User'  => 'ROLE_USER'
                    )
                ));
    }

    public function getName() {
        return 'user';
    }

}
