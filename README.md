# Coding Challenge Software Engineer

## Overview 

This project is a Laravel-based application that allows users to manage and list products via CLI commands and a web API. It includes features such as product creation, filtering by category, and sorting by price.

## Requirements

- PHP 8.x
- Composer
- MySQL (or any database supported by Laravel)

## Installation Steps

1. **Clone the repository**:
```bash 
git clone https://github.com/ayoubsabi/adz-coding-challenge
cd adz-coding-challenge
```
2. **Install dependencies**
```bash 
composer install
```
3. **Configure the environment**
    - Copy `.env.example` to `.env` and update it with the correct database credentials and other environment configurations:
```bash 
cp .env.example .env
``` 
4. **Run database migrations**:
```bash 
php artisan migrate
```
5. **Run the application**:
```bash 
php artisan serve
```
## CLI Commands

### Create a Product
You can create a new product via the CLI by running the following Artisan command:
```bash 
php artisan app:create-product
```
This command will prompt you to enter product details such as the name, description, price, ...etc.

## API Endpoints

### List Products
- **Endpoint**: `GET: /api/products`
- **Description**: Fetches a list of all products.
- **Filters**:
	- Filter by category: `http://127.0.0.1:8000/api/products?category_id=1`
	- Sort by price ascending: `http://127.0.0.1:8000/api/products?sort_by_price=asc`
	- Sort by price descending: `http://127.0.0.1:8000/api/products?sort_by_price=desc`

## Testing

### Running Tests
To run the automated tests for product creation, execute the following command:
```bash 
vendor/bin/phpunit
```