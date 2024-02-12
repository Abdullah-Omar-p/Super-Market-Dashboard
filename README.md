# [ [SuperMarketDashboard Project - API Documentation](#) ]


# ``Authentication Endpoints``
### - [Register](#)
**``URL``**: /auth/register <br>
**``Method``**: POST <br>
**``Description``**: Register a new user. <br>
#### Request Body:
**``name``**: name <br>
**``email``**: email <br>
**``password``**: password <br>
**``Confirm Password``**: password_confirmation <br>

#### Response:
Returns a success message if registration is successful. <br>
### - [Login](#)
**``URL``**: /auth/login <br>
**``Method``**: POST <br>
**``Description``**: Authenticate a user and generate an access token. <br>
#### Request Body:
**``email``**: User's email <br>
**``password``**: User's password <br>
#### Response:
Returns an access token if authentication is successful. <br>
### - [Logout](#)
``URL``: /auth/logout <br>
``Method``: POST <br>
``Description``: Logout the currently authenticated user. <br>
``Authorization Header``: Bearer token <br>
#### Response:
Returns a success message upon successful logout. <br>











# ``Activities Endpoints``

### - [Get All Activities](#)
**URL**: /activities <br>
**Method**: GET <br>
**Description**: Fetch all activities. <br>
**Response**: Returns a paginated list of activities. <br>







# ``Debt Endpoints``

### - [Add New Debt](#)
**``URL``**: /dubt/add <br>
**``Method``**: POST <br>
**``Description``**: Add a new debt. <br>
#### Request Body:
- **``status``**: Debt status (1 for own debt, 0 for others) <br>
- **``name``**: Name of the debtor <br>
- **``liability``**: Amount of liability <br>
- **``phone``**: Debtor's phone number <br>
#### Response:
Returns a success message and the created debt details if successful.

### - [Delete Debt](#)
**``URL``**: /dubt/delete <br>
**``Method``**: POST <br>
**``Description``**: Delete a debt by its ID. <br>
#### Request Body:
- **``debt_id``**: ID of the debt to be deleted <br>
#### Response:
Returns a success message if the debt is deleted successfully.

### - [Update Debt (Decrement)](#)
**``URL``**: /dubt/update-decrement/{increment_or_decrement?} <br>
**``Method``**: POST <br>
**``Description``**: Update a debt record by decrementing the liability. <br>
#### Request Body:
- **``id``**: Debt ID (required)
- **``status``**: Status (required, 1 or 0)
- **``name``**: Name (required)
- **``increment_or_decrement``**: Increment or Decrement (required, 1 for decrement)
- **``money``**: Amount of money to decrement (required)
#### Response:
Phone number (required)

**``Response``**: Returns the updated debt record if successful. <br>

### - [Update Debt (Increment)](#)
**``URL``**: /dubt/update-increment/{increment_or_decrement?} <br>
**``Method``**: POST <br>
**``Description``**: Update a debt record by incrementing the liability. <br>
#### Request Body:
- **``id``**: Debt ID (required)
- **``status``**: Status (required, 1 or 0)
- **``name``**: Name (required)
- **``increment_or_decrement``**: Increment or Decrement (required, 0 for increment)
- **``money``**: Amount of money to increment (required)
- **``phone``**: Phone number (required)

#### Response:
Returns the updated debt record if successful. <br>

### - [Get Debts](#)
**``URL``**: /dubt/for-you/{status?} or /dubt/for-others/{status?} <br>
**``Method``**: GET <br>
**``Description``**: Get debts filtered by status. <br>
#### Parameters:
- **``status``**: (Optional) Status of the debts (0 or 1) <br>
#### Response:
Returns a JSON array containing the debts that match the specified status.










# ``Order Endpoints``

### - [Make Order](#)
**``URL``**: /order <br>
**``Method``**: POST <br>
**``Description``**: Make a new order. <br>
#### Request Body:
- **``product_ids``**: An array of product IDs to be included in the order. <br>
- **``total_price``**: (Optional) Total price of the order. <br>
- **``no_pices``**: (Optional) Number of pieces in the order. <br>
#### Response:
Returns a JSON object containing the following:
- **``products``**: An array of products included in the order, each containing name, price, and available pieces.
- **``total-price``**: Total price of the order.
- **``no - pices``**: Number of pieces in the order.









# ``Product Endpoints``

### - [Add Product](#)
**``URL``**: /product/add <br>
**``Method``**: POST <br>
**``Description``**: Add a new product to the system. <br>
#### Request Body:
- **``name``**: Name of the product (required).
- **``barcode``**: Barcode of the product (optional, must be unique).
- **``description``**: Description of the product (optional).
- **``available_pices``**: Number of available pieces of the product (required).
- **``price``**: Price of the product (required).
#### Response:
Returns a JSON object containing the following:
- **``status``**: Status of the operation.
- **``message``**: A message indicating the success of the operation.
- **``product``**: Details of the newly added product.


### - [Delete Product](#)
**``URL``**: /product/delete <br>
**``Method``**: POST <br>
**``Description``**: Delete an existing product from the system. <br>
#### Request Body:
- **``product_id``**: ID of the product to be deleted (required).
#### Response:
Returns a JSON object containing a message indicating the success of the operation.

### - [ Edit Available Pieces of a Product](#)
**``URL``**: /product/availale-pices <br>
**``Method``**: POST <br>
**``Description``**: Update the available pieces of a product in the system. <br>
#### Request Body:
- **``product_id``**: ID of the product to be updated (required).
- **``available_pices``**: New available pieces count for the product (required).
#### Response:
Returns a JSON object containing a message indicating the success of the operation, along with the updated available pieces count.

### - [Search for a Specific Product by Barcode or Name](#)
**``URL``**: /product/search-barcode or /product/search-name <br>
**``Method``**: GET <br>
**``Description``**: Search for a product by its barcode or name in the system. <br>
#### Query Parameters:
- **``name``**: Name of the product to search for (required if barcode is not provided).
- **``barcode``**: Barcode of the product to search for (required if name is not provided).
#### Response:
Returns a JSON object containing the details of the product if found, or a message indicating that the product is not found.

### - [Get Products Or Search for Products by Name or Barcode](#)
**``URL``**: /product/search <br>
**``Method``**: POST <br>
**``Description``**: Search for products by their name or barcode in the system. <br>
#### Request Body:
- **``name``**: Name of the product to search for (required if barcode is not provided).
- **``barcode``**: Barcode of the product to search for (required if name is not provided).
#### Response:
Returns a JSON object containing an array of products that match the search criteria, or a message indicating that no products were found.

### - [Update Product](#)
**``URL``**: /product/update <br>
**``Method``**: POST <br>
**``Description``**: Update an existing product in the system. <br>
#### Request Body:
- **``id``**: ID of the product to update (required).
- **``name``**: New name for the product (required).
- **``barcode``**: New barcode for the product (optional).
- **``description``**: New description for the product (optional).
- **``available_pices``**: New available pieces for the product (required).
- **``price``**: New price for the product (required).
#### Response:
Returns a JSON object containing a message indicating the success or failure of the update operation, along with the updated product information if successful.

### - [Get Product Warnings](#)
**``URL``**: /product/warnings <br>
**``Method``**: GET <br>
**``Description``**: Get warnings for products with low available pieces. <br>
#### Response:
Returns a JSON object containing warning messages for products with available pieces less than 90. If no products have low available pieces, it returns a message indicating so.








# ``Statistics Endpoints``

### - [Get Daily Statistics](#)
**``URL``**: /statistics/daily <br>
**``Method``**: GET <br>
**``Description``**: Get total earnings and total number of sold products for the current day. <br>
#### Response:
Returns a JSON object containing the total earnings and total number of sold products for the current day.

### - [Get Weekly Statistics](#)
**``URL``**: /statistics/weekly <br>
**``Method``**: GET <br>
**``Description``**: Get total earnings, total number of sold products, and number of added products for the current week. <br>
#### Response:
Returns a JSON object containing the total earnings, total number of sold products, and number of added products for the current week.

### - [Get Monthly Statistics](#)
**``URL``**: /statistics/monthly <br>
**``Method``**: GET <br>
**``Description``**: Get total earnings and total number of sold products for the current month. <br>
#### Response:
Returns a JSON object containing the total earnings and total number of sold products for the current month.