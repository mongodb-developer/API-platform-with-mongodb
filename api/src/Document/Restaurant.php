<?php

namespace App\Document;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Id;

#[ApiResource]
#[Document]
class Restaurant
{
    #[Id]
    public string $id;

    #[Field]
    public string $name;

    #[Field]
    public string $address;

    #[Field]
    public string $borough;

    #[Field]
    public string $cuisine;

    public function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getBorough(): string
    {
        return $this->borough;
    }

    public function getCuisine(): string
    {
        return $this->cuisine;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setBorough(string $borough): void
    {
        $this->borough = $borough;
    }

    public function setCuisine(string $cuisine): void
    {
        $this->cuisine = $cuisine;
    }
}
