# Project Documentation

## Overview
This project is a web application built using PHP, Laravel, and other technologies. It includes features such as user authentication, product management, and a rating system.

## Usage

### Authentication
This project uses JWT authentication for the API. To log in, send a `POST` request to `/api/auth/login` with the user's credentials.

Default admin user:
- Email: `admin@email.com`
- Password: `12345678`

After logging in, copy the token from the response and set it in the Postman collection's global variable `jwt` to authenticate.  
Note: You might need to switch the authentication type to Bearer Token.

### Endpoints

Examples of endpoints:

- **User Endpoints:**
    - `POST /api/users` - Create a new user
    - `GET /api/users` - List all users
    - `GET /api/users/{id}` - Get user details
    - `PUT /api/users/{id}` - Update user
    - `DELETE /api/users/{id}` - Delete user

- **Product Endpoints:**
    - `POST /api/products` - Create a new product
    - `GET /api/products` - List all products
    - `GET /api/products/{id}` - Get product details
    - `PUT /api/products/{id}` - Update product
    - `DELETE /api/products/{id}` - Delete product

- **Rating Endpoints:**
    - `POST /api/ratings` - Create a new rating
    - `GET /api/ratings` - List all ratings
    - `GET /api/ratings/{id}` - Get rating details
    - `PUT /api/ratings/{id}` - Update rating
    - `DELETE /api/ratings/{id}` - Delete rating

**Note: Authentication is required to access these endpoints.**

**Recommendation System:**  
The recommendation system works based on relational data between customer-type users and their movie purchases. A Python model is used to generate these recommendations, which are consumed by the Laravel API.

### Collections

The system's Postman collection is provided in the `crm_endpoints.json` file. To import the collection, open Postman, click on `Import`, and select the file.  
This collection contains all existing project endpoints, with examples of requests for each one. (If necessary, just modify the request body).

### Filters Usage

The filters are used to search for specific data in the system, they are the `params` in the URL.
- Log Filter: `api/logs?user_id={user_id}&search={search}`
  - `user_id`: Filter logs by user ID
  - `search`: Search logs by action or model
- Products Filter: `api/products?search={search}`
  - `search`: Search products by title


## License
This project is licensed under the MIT License.
