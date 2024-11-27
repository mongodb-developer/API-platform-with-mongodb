# How to Build REST APIs with API Platform and MongoDB

## Introduction

Modern web applications rely heavily on real-time database interactions and efficient management of large datasets. However, developers often face challenges in handling dynamic, unstructured data while maintaining performance, scalability, and flexibility. Combining **Symfony's API Platform** with **MongoDB** simplifies the process of building robust, flexible, and secure REST APIs. 

In this project, we demonstrate how to:
- Build REST APIs using **Symfony's API Platform**.
- Perform CRUD (Create, Read, Update, Delete) operations.
- Connect the application to **MongoDB Atlas**.

By the end of this tutorial, you’ll have a working application capable of efficiently managing database interactions using the API Platform with MongoDB.

---

## Prerequisites

Before starting, ensure you have the following:
- **A free MongoDB Atlas cluster**: [Register and create your first free cluster](https://www.mongodb.com/cloud/atlas).
- **PHP 8.x or higher**.
- **Docker** installed for containerized development.

---

## Steps to Build the Application

### 1. Setting Up the Symfony Project

1. Create a new GitHub repository for your project.
2. Clone the repository locally:
   ```bash
   git clone <repository_url>
   ```
3. Generate a Symfony project with the API Platform:
   ```bash
   composer create-project symfony/skeleton my_project
   cd my_project
   composer require api
   ```

### 2. Connecting the Application to MongoDB

#### Option 1: Using Docker
1. Add a MongoDB service to your `docker-compose.yml` file:
   ```yaml
   services:
     mongodb:
       image: mongo
       container_name: mongodb
       ports:
         - "27017:27017"
       environment:
         MONGO_INITDB_ROOT_USERNAME: root
         MONGO_INITDB_ROOT_PASSWORD: example
   ```
2. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

#### Option 2: Using MongoDB Atlas
1. Create a free Atlas cluster and retrieve your connection string.
2. Update your `.env` file:
   ```env
   MONGODB_URL=<your_atlas_connection_string>
   MONGODB_DB=<database_name>
   ```
3. Install the MongoDB ODM bundle:
   ```bash
   docker compose exec php composer require doctrine/mongodb-odm-bundle
   ```

---

### 3. Defining a Document Class

Create a document class to map the MongoDB schema. For example, a **Restaurant** document might look like this:

```php
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
}
```

---

### 4. CRUD Operations with API Platform

#### Create
Define a POST endpoint in the `RestaurantController`:

```php
public function create(Request $request): JsonResponse
{
    $data = json_decode($request->getContent(), true);

    $restaurant = new Restaurant();
    $restaurant->name = $data['name'];
    $restaurant->address = $data['address'];
    $restaurant->borough = $data['borough'];
    $restaurant->cuisine = $data['cuisine'];
    
    $this->documentManager->persist($restaurant);
    $this->documentManager->flush();

    return new JsonResponse(['status' => 'Restaurant created!'], JsonResponse::HTTP_CREATED);
}
```

#### Read
Retrieve a document by ID:

```php
public function read(string $id): JsonResponse
{
    $restaurant = $this->repository->find($id);

    if (!$restaurant) {
        return new JsonResponse(['error' => 'Not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    return new JsonResponse($restaurant);
}
```

#### Update
Modify an existing document:

```php
public function update(string $id, Request $request): JsonResponse
{
    $restaurant = $this->repository->find($id);

    if (!$restaurant) {
        return new JsonResponse(['error' => 'Not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    $data = json_decode($request->getContent(), true);
    $restaurant->name = $data['name'];
    $restaurant->address = $data['address'];
    $restaurant->borough = $data['borough'];
    $restaurant->cuisine = $data['cuisine'];

    $this->documentManager->flush();

    return new JsonResponse(['status' => 'Restaurant updated!']);
}
```

#### Delete
Remove a document by ID:

```php
public function delete(string $id): JsonResponse
{
    $restaurant = $this->repository->find($id);

    if (!$restaurant) {
        return new JsonResponse(['error' => 'Not found'], JsonResponse::HTTP_NOT_FOUND);
    }

    $this->documentManager->remove($restaurant);
    $this->documentManager->flush();

    return new JsonResponse(['status' => 'Restaurant deleted']);
}
```

---

### 5. Testing the APIs

1. Start the application:
   ```bash
   docker-compose up
   ```
2. Access the API documentation at:
   ```
   http://localhost:8080/docs
   ```
3. Test the endpoints using tools like **Postman**, **cURL**, or the interactive API docs.

---

## Sample Data

Example of a restaurant document:

```json
{
  "name": "Spice of India",
  "address": "73-10 Grand Ave, Maspeth, NY 11378",
  "borough": "Queens",
  "cuisine": "Indian"
}
```

---

## Conclusion

By using **Symfony's API Platform** and **MongoDB**, you can efficiently manage RESTful APIs for dynamic and unstructured data. This combination provides:
- Scalability.
- Simplified CRUD operations.
- Seamless integration with MongoDB Atlas or Docker-based MongoDB setups.

Explore the repository for more advanced features like query optimization and schema evolution. Feel free to extend this project to suit your application's needs!
