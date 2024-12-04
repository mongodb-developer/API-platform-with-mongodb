<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class MinimalProperties extends Constraint
{
    public $message = 'The product must have the minimal properties required ("name", "cuisine", "bourough")';
}