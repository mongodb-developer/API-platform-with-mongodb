<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Symfony\Component\Validator\Constraints as Assert;

#[EmbeddedDocument]
class Address
{
    #[Field]
    public string $building;

    #[Field]
    public string $street;

    #[Field]
    #[Assert\Regex(pattern: '/^[0-9]{5}$/', message: 'Zipcode must be 5 digits')]
    public string $zipcode;
}
