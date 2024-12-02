<?php

namespace App\Controller;

use App\Document\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @Route("/restaurants", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $restaurant = new Restaurant();
        $restaurant->setId($data['_id']['$oid']);
        $restaurant->setName($data['name']);
        $restaurant->setAddress($data['address']);
        $restaurant->setBorough($data['borough']);
        $restaurant->setcuisine($data['cuisine']);

        $this->restaurantRepository->save($restaurant);

        return new JsonResponse(['status' => 'Restaurant created!'], JsonResponse::HTTP_CREATED);
    }

    /**
     * @Route("/restaurants/{id}", methods={"GET"})
     */
    public function read($id): JsonResponse
    {
        $restaurant = $this->restaurantRepository->findById($id);

        if (!$restaurant) {
            return new JsonResponse(['status' => 'Restaurant not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse($restaurant);
    }

    /**
     * @Route("/restaurants/{id}", methods={"PUT"})
     */
    public function update($id, Request $request): JsonResponse
    {
        $restaurant = $this->restaurantRepository->findById($id);

        if (!$restaurant) {
            return new JsonResponse(['status' => 'Restaurant not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        $restaurant->setAddress($data['address']);
        $restaurant->setBorough($data['borough']);
        $restaurant->setcuisine($data['cuisine']);
        $restaurant->setName($data['name']);
        $this->restaurantRepository->save($restaurant);

        return new JsonResponse(['status' => 'Restaurant updated!']);
    }

    /**
     * @Route("/restaurants/{id}", methods={"DELETE"})
     */
    public function delete($id): JsonResponse
    {
        $restaurant = $this->restaurantRepository->findById($id);

        if (!$restaurant) {
            return new JsonResponse(['status' => 'Restaurant not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        $this->restaurantRepository->delete($restaurant);

        return new JsonResponse(['status' => 'Restaurant deleted']);
    }
}
