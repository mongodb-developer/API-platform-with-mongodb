<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class ValidZipcodeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof ValidZipCode) {
            throw new \InvalidArgumentException(sprintf('Expected instance of %s, got %s.', ValidZipCode::class, get_class($constraint)));
        }

        if (!preg_match('/^[0-9]{5}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
