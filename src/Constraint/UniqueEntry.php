<?php

namespace projet4\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Unique extends Constraint 
{
    public $message = '{{ string }} est déjà utilisé.';
    public $entity;
    public $field;
}