<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class MinimalPropertiesValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (array_diff(['name', 'cuisine', 'bourough'], $value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}