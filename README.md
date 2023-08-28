# Laravel API CRUD with Passport 

This project encompasses a demonstration of a Laravel API CRUD application integrated with Passport authentication, showcasing distinct user roles of User and Admin.

## Getting Started

These instructions will help you set up and run the project locally on your machine.

### Prerequisites

- PHP >= 8
- Composer (https://getcomposer.org/download/)
- MySQL
- Web server (e.g., Apache, Nginx)

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/SanketAmin/Laravel_API_CRUD.git

2. Navigate to the project directory:

   ```bash
    cd project-name

3. Install the project dependencies:

    ```bash
    composer install

4. Create a copy of the .env.example file and rename it to .env:

    ```bash
    cp .env.example .env

5. Configure the .env file with your database and other environment settings.

6. Generate the application key:

    ```bash
    php artisan key:generate

7. Run the database migrations and seeders:

    ```bash
    php artisan migrate --seed

8. Start the development server:

    ```bash
    php artisan serve

### Setting up Laravel Passport (https://laravel.com/docs/10.x/passport)

1. Install Laravel Passport:

   ```bash
   composer require laravel/passport

2. Run the Passport installation command:

    ```bash
    php artisan passport:install

3. Add Passport Keys:

    ```bash
   php artisan passport:keys

4. Vendor Publish:

    ```bash
   php artisan vendor:publish --tag=passport-config

### API Endpoints


Here are the API endpoints provided by the project:

#### User Registration

- Endpoint: `POST /api/v1/register`
- Description: Register a new user and role can be user or admin.
  - Request Body:
  ```json
    {
        "name": "User Name",
        "email": "user@example.com",
        "password": "your_password",
        "role": "user"
    }
    
#### User Login

- Endpoint: `POST /api/v1/login`
- Description: Register a new user and role can be user or admin.
  - Request Body:
  ```json
    {
        "email": "user@example.com",
        "password": "your_password"
    }

#### User Logout

- Endpoint: `POST /api/v1/logout`
- Description: Register a new user and role can be user or admin.
- Authentication Required: Yes



### Admin-Only Routes

#### Delete Financial Transaction

- Endpoint: `POST /api/v1/delete/transaction`
- Description: Delete a financial transaction (Admin only).
- Request Body:
  ```json
    {
      "transaction_id" : 2
    }
  
### User-Only Routes

#### Create Financial Transaction

- Endpoint: `POST /api/v1/create/transaction`
- Description: Create a new financial transaction (User only).
- Authentication Required: Yes (User)
- Request Body:
  ```json
  {
      "amount": 500,
      "description": "Test Description"
  }

#### Get All User Transactions

- Endpoint: `POST /api/v1/all-user-transactions`
- Description: Get all financial transactions of the authenticated user (User only).
- Authentication Required: Yes (User)
- Response: List of user's financial transactions.

##### Update Financial Transaction

- Endpoint: `POST /api/v1/update/transaction`
- Description: Update an existing financial transaction (User only).
- Authentication Required: Yes (User)
- Request Body:
  ```json
  {
      "transaction_id": 123, // ID of the transaction to update
      "amount": 600,
      "description": "Updated Description"
  }

## Security Measures

Here are the security measures implemented in the project to ensure the protection of user data and system integrity:

### Authentication with Laravel Passport

- **Importance:** Authentication ensures that only authorized users can access sensitive information or perform specific actions within the application. Passport provides a secure token-based authentication system that prevents unauthorized access.

### Role-Based Authorization

- **Importance:** Role-based authorization ensures that users can only access the parts of the application that are relevant to their role. Admins should have access to administrative features, while regular users should only be able to perform actions they are authorized for.

### Route-Level Middleware

- **Importance:** Route-level middleware helps prevent unauthorized users from accessing specific routes. By applying middleware, you can ensure that only users with the appropriate role can perform actions that are meant for them.

### API Token Usage

- **Importance:** API tokens allow users to authenticate without exposing their actual credentials. This minimizes the risk of credentials being intercepted or stolen during communication.

### Request Validation and Error Handling

- **Importance:** Proper error handling helps maintain the security and usability of the application. Providing informative error messages to users can prevent potential security breaches by guiding them towards correct usage.


