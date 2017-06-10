<?php

namespace projet4\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class EpisodeType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', TextType::class, array(
                    'required'    => true,
                    'constraints' => array(
                        new Assert\NotBlank(), 
                        new Assert\Length(array(
                        'min' => 5,'max' => 100,
                        ))),
                ))
                ->add('content', TextareaType::class, array(
                    'required'    => false,
                    'constraints' => new Assert\NotBlank(),
                    'attr' => array(
                        'class' => 'tinymce'
                    )
        ));
    }

    public function getName() {
        return 'episode';
    }

}