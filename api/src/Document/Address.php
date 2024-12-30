<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbeddedDocument;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use App\Validator\Constraints\ValidZipCode;

#[EmbeddedDocument]
class Address
{
    #[Field]
    public string $building;

    #[Field]
    public string $street;

    #[Field]
    #[ValidZipCode]
        public string $zipcode;
}
