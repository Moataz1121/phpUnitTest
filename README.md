# 📂 Category Management Project (Laravel 12)

## 🧩 Overview
This project is a simple **Category Management System** built using **Laravel 12**.  
It demonstrates **API and Web CRUD operations** for categories and includes **comprehensive PHPUnit feature tests** for both web and API layers.

The main goal of the project is to practice **Laravel testing techniques** and ensure that all functionalities are working as expected through automated tests.

---

## ⚙️ Tech Stack

| Component | Technology Used |
|------------|-----------------|
| Framework | Laravel 12 |
| Database | MySQL |
| Authentication | Laravel Sanctum |
| Testing | PHPUnit |
| Language | PHP 8+ |

---

## 🧱 Features

### 🖥️ Web Interface
- View all categories (with pagination)
- Create a new category
- Edit existing categories
- Delete categories
- Validation for inputs (name and description)

### 🌐 API Endpoints
All API routes are protected with **Laravel Sanctum Authentication**.

| Method | Endpoint | Description | Auth Required |
|---------|-----------|-------------|----------------|
| `GET` | `/api/categories` | Get all categories | ✅ |
| `POST` | `/api/categories` | Create new category | ✅ |
| `GET` | `/api/categories/{id}` | Show specific category | ✅ |
| `PUT` | `/api/categories/{id}` | Update category | ✅ |
| `DELETE` | `/api/categories/{id}` | Delete category | ✅ |

Additionally, there's a `POST /api/login` route that generates an API token for authentication.

---

## 🧪 Testing

The project includes **Feature Tests** to ensure that:
- CRUD operations work correctly (both for web and API)
- Validation rules are respected
- Authentication is properly enforced
- Pagination behaves as expected

### 📁 Test Files:
- `Tests/Feature/Categories/CaregoryCreatingTest.php` → Tests category creation & validation (Web)
- `Tests/Feature/Categories/CategoryRetrievalTest.php` → Tests retrieving and paginating categories (Web)
- `Tests/Feature/Categories/CategoryApiTest.php` → Tests API CRUD endpoints (API)

---

2️⃣ Install dependencies 
composer install

3️⃣ Create the environment file
cp .env.example .env

4️⃣ Configure your database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password


5️⃣ Generate application key
php artisan key:generate

6️⃣ Run migrations
php artisan migrate

7️⃣ Run the development server
php artisan serve

🧾 Running Tests
php artisan test
php artisan test --filter=CategoryApiTest


vendor/bin/phpunit


Database Structure

Table: categories

Column	    Type	        Description
id	        bigint	        Primary Key
name	    varchar(255)	Category Name
description	text            (nullable)	Category Description
created_at	timestamp	    Creation Time
updated_at	timestamp	    Update Time
