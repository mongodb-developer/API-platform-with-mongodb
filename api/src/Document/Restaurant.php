<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RestaurantRepository;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

#[ApiResource]
#[Document(collection: 'restaurants', repositoryClass: RestaurantRepository::class)]
class Restaurant
{
    #[Id]
    public string $id;

    #[Field]
    public string $name;

    #[Field]
    public array $address;

    #[Field]
    public string $borough;

    #[Field]
    public string $cuisine;
}
