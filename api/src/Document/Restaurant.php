<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RestaurantRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[Document(collection: 'restaurants', repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[Id]
    public string $id;

    #[Field]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public string $name;

    #[EmbedOne(targetDocument: Address::class)]
    public ?Address $address;

    #[Field]
    #[Assert\NotBlank]
    public string $borough;

    #[Field]
    #[Assert\NotBlank]
    public string $cuisine;
}
