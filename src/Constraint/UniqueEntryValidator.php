<?php
namespace projet4\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEntryValidator extends ConstraintValidator 
{
    private $app;

    public function __construct($app) {
        $this->app = $app;
    }
    /**
     * /
     * @param  [type]     $value      [description]
     * @param  Constraint $constraint [description]
     * @return [type]                 [description]
     */
    public function validate($value, Constraint $constraint)
    {
        $sameValue = $this->app['dao.user']->findOneBy(array($constraint->field, $value));
            if ($sameValue)
            {
                $this->context->buildViolation($constraint->message)
                     ->setParameter('{{ string }}', $value)
                     ->addViolation();
                return false;
            }
    }
}