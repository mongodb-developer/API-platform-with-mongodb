<?php

namespace App\Document;

use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\RestaurantRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\EmbedOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource]
#[ApiFilter(
    SearchFilter::class,
    properties: [
        'name' => 'ipartial', // The "ipartial" strategy will use a case-insensitive partial match
        'cuisine' => 'exact', // The "exact" strategy will use an exact match
    ])
]
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
    #[Assert\Valid]
    public ?Address $address;

    #[Field]
    #[Assert\NotBlank]
    public string $borough;

    #[Field]
    #[Assert\NotBlank]
    public string $cuisine;
}
