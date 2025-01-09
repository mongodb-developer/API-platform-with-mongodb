# How to Build REST APIs With API Platform and MongoDB  

This repository demonstrates how to build robust, scalable REST APIs using [API Platform](https://api-platform.com/) with MongoDB as the database. The project is built using Symfony and integrates seamlessly with MongoDB Atlas for efficient CRUD operations.  

## Features  
- Use of **API Platform** to simplify API creation, documentation, and validation.  
- Integration with **MongoDB Atlas**, a cloud-based NoSQL database.  
- Complete CRUD (Create, Read, Update, Delete) operations on a MongoDB collection.  
- Advanced features like data validation, filtering, and custom constraints.  
- OpenAPI-compliant documentation via Swagger UI.  

## Prerequisites  
Ensure the following tools are installed:  
- [Docker](https://www.docker.com/products/docker-desktop/)  
- A free MongoDB Atlas cluster. [Sign up here](https://www.mongodb.com/cloud/atlas).  

## Getting Started  

### Clone the Repository  
```bash  
git clone <URL-to-your-repository>  
cd <repository-name>  
```  

### Install Dependencies  
Update the Dockerfile to include MongoDB extensions:  
```Dockerfile  
RUN apt-get update && apt-get install --no-install-recommends -y \  
	libcurl4-openssl-dev \  
    libssl-dev \  
    && pecl install mongodb \  
    && docker-php-ext-enable mongodb  
```  

Build the Docker container:  
```bash  
docker compose build --no-cache  
```  

### Connect to MongoDB Atlas  
1. Create a MongoDB Atlas cluster.  
2. Get your connection string from Atlas (e.g., `mongodb+srv://<user>:<password>@cluster.mongodb.net/?retryWrites=true&w=majority`).  
3. Update the `.env` file in the project root:  
```env  
MONGODB_URL=<your-atlas-uri>  
MONGODB_DB=<your-database-name>  
```  

### Start the Application  
Start the containers and install required bundles:  
```bash  
docker compose up --wait  
docker compose exec php composer require doctrine/mongodb-odm-bundle api-platform/doctrine-odm  
```  

## CRUD Operations  
This project includes a sample `Restaurant` collection with fields like name, address, borough, and cuisine.  

### Endpoints  
After the application is running, access the Swagger UI documentation:  
[https://localhost:8443/docs](https://localhost:8443/docs)  

- **Create**: POST `/restaurants`  
- **Read All**: GET `/restaurants`  
- **Read One**: GET `/restaurants/{id}`  
- **Update**: PATCH `/restaurants/{id}`  
- **Delete**: DELETE `/restaurants/{id}`  

### Example JSON for CRUD  
#### Create  
```json  
{  
  "name": "The Gourmet Spot",  
  "address": {  
    "building": "123",  
    "street": "Elm Street",  
    "zipcode": "12345"  
  },  
  "borough": "Manhattan",  
  "cuisine": "Italian"  
}  
```  

#### Update  
```json  
{  
  "name": "The Gourmet Spot",  
  "address": {  
    "building": "123",  
    "street": "Elm Street",  
    "zipcode": "12345"  
  },  
  "borough": "New York",  
  "cuisine": "Spanish"  
}  
```  

## Validation and Advanced Features  
- **Field Validations**: Ensure required fields like `name`, `borough`, and `cuisine` are present.  
- **Custom Constraints**: Includes validation for zip codes using Symfony validators.  

## Contributing  
Feel free to fork this repository and submit pull requests with enhancements or bug fixes.    
