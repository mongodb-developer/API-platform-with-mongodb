<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValidZipCode extends Constraint
{
    public $message = 'The zipcode "{{ value }}" is not valid. It must be exactly 5 digits.';
}
