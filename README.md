# SuperMarketDashboard Project - API Documentation 

## Authentication Endpoints
### Register a New User
**URL**: /auth/register
**Method**: POST
**Description**: Register a new user.
#### Request Body:
**name**: User's name
**email**: User's email
**password**: User's password
**Response**: Returns a success message if registration is successful.
### Login
**URL**: /auth/login
**Method**: POST
**Description**: Authenticate a user and generate an access token.
#### Request Body:
**email**: User's email
**password**: User's password
**Response**: Returns an access token if authentication is successful.
### Logout
URL: /auth/logout
Method: POST
Description: Logout the currently authenticated user.
Authorization Header: Bearer token
Response: Returns a success message upon successful logout.

## Product Endpoints
Add Product
URL: /product/add
Method: POST
Description: Add a new product to the system.
Request Body:
Product details (name, barcode, description, price, etc.)
Authorization Header: Bearer token
Response: Returns the added product details.
Delete Product
URL: /product/delete
Method: POST
Description: Delete a product from the system.
Request Body:
product_id: ID of the product to be deleted
Authorization Header: Bearer token
Response: Returns a success message upon successful deletion.
Update Product
URL: /product/update
Method: POST
Description: Update an existing product in the system.
Request Body:
Product details to be updated
Authorization Header: Bearer token
Response: Returns the updated product details.
Search Product by Barcode
URL: /product/search-barcode
Method: GET
Description: Search for a product by its barcode.
Query Parameters:
barcode: Barcode number of the product
Authorization Header: Bearer token
Response: Returns the product details.
Search Product by Name
URL: /product/search-name
Method: GET
Description: Search for a product by its name.
Query Parameters:
name: Name of the product
Authorization Header: Bearer token
Response: Returns the product details.
Update Available Pieces
URL: /product/availale-pices
Method: POST
Description: Update the available pieces of a product.
Request Body:
product_id: ID of the product
new_available_pieces: New available pieces count
Authorization Header: Bearer token
Response: Returns the updated product details.
