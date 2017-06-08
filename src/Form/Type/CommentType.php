<?php

namespace projet4\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Validator\Constraints as Assert;

class CommentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('email', EmailType::class, [
                    'label'           => 'Votre eMail ',
                    'attr'            => ['placeholder' => '(ne sera pas publié)'],
                    'required'        => true,
                    'invalid_message' => 'Cet eMail n\'est pas valide.',
                    'constraints'     => new Assert\Email(['checkMX' => true]),
                ])
                ->add('website', UrlType::class, [
                    'label'           => 'Votre site web',
                    'required'        => false,
                    'constraints'     => new Assert\Url(),
                    'invalid_message' => 'Cette URL n\'est pas valide.',
                ])
                ->add('content', TextareaType::class,[
                    'label'       => 'Votre commentaire',
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
        ]);
    }

    public function getName() {
        return 'comment';
    }

}
   