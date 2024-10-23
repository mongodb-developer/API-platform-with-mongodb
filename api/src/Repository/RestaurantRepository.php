<?php

namespace App\Repository;

use App\Document\Restaurant;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;

class RestaurantRepository extends DocumentRepository
{
    public function findById(string $id): ?Restaurant
    {
        return $this->find($id);
    }

    public function save(Restaurant $restaurant): void
    {
        $dm = $this->getDocumentManager();
        $dm->persist($restaurant);
        $dm->flush();
    }

    public function delete(Restaurant $restaurant): void
    {
        $dm = $this->getDocumentManager();
        $dm->remove($restaurant);
        $dm->flush();
    }
}
