<?php

namespace projet4\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints as Assert;

class CommentType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('content', TextareaType::class,[
                    'label'       => 'Votre commentaire',
                    'required'    => true,
                    'constraints' => new Assert\NotBlank(),
        ]);
    }

    public function getName() {
        return 'comment';
    }

}
   