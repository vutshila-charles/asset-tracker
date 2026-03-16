# Asset Inspection API

A simple Laravel REST API to manage **Assets** and their **Inspections**.

---

# Features

* RESTful API built with Laravel
* Asset - Inspection one-to-many relationship
* Create assets with validation
* Fetch assets with their latest inspections
* Laravel API Resources (Transformers)
* Request validation using Form Requests
* Factories and seeders for sample data
* Feature tests
* Optional authentication using Laravel Sanctum
* Interactive API documentation built with Vue + Tailwind

---

# Tech Stack

Laravel
PHP
SQLite
Vue.js
Tailwind CSS
Laravel Sanctum
PHPUnit

---

# Installation

Clone the repository

```
git clone https://github.com/vutshila-charles/asset-tracker.git
```

```
cd asset-tracker
```

Install dependencies

```
composer install
npm install
```

Generate application key

```
php artisan key:generate
```

---

#  Setup 

```
touch .env
```

Copy the example .env file


Run migrations and seed the database

```
php artisan migrate --seed
```

This will create

* 1 admin user
* 10 assets
* multiple inspections per asset

---

# Running the Application

Start Laravel server

```
php artisan serve
```

Start frontend assets

```
npm run dev
```

API will be available at

```
http://localhost:8000/api
```

Interactive API docs

```
http://localhost:8000/
```

---

# Authentication

Authentication uses **Laravel Sanctum**.

Register

```
POST /api/register
```

Example request

```
{
  "name": "John Doe",
  "email": "john@test.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

Login

```
POST /api/login
```

Response

```
{
  "token": "1|example_token"
}
```

Use token in requests

```
Authorization: Bearer TOKEN
```

---

# API Endpoints

Create Asset

```
POST /api/assets
```

Request

```
{
  "name": "Generator A",
  "serial_number": "GEN-001",
  "status": "active"
}
```

Validation

* name required
* serial_number unique
* status must be active, maintenance, or retired

---

Fetch Asset with Latest Inspections

```
GET /api/assets/{id}
```

Version 1 of the API

This is the same endpoitns as above but this requires aauthentication.

Request
```
GET /api/v1/assets/{id}
```

Response

```
{
  "data": {
    "id": 1,
    "name": "Generator A",
    "serial_number": "GEN-001",
    "status": "active",
    "inspections": [
      {
        "id": 1,
        "inspector_name": "John Doe",
        "passed": true,
        "notes": "Good condition"
      },
      {
        "id": 2,
        "inspector_name": "Jane Doe",
        "passed": false,
        "notes": "Needs repair"
      },
      {
        "id": 3,
        "inspector_name": "John Doe",
        "passed": true,
        "notes": "Good condition"
      }
    ]
  }
}
```

Request

```
POST /api/v1/assests
```



Returns the asset and its **latest 3 inspections**.

---

# Rate Limiting

API endpoints are protected with Laravel throttling.

Limit

```
60 requests per minute
```

---

# Database Structure

Assets

```
id
name
serial_number
status
created_at
updated_at
```

Inspections

```
id
asset_id
inspector_name
passed
notes
created_at
updated_at
```

Relationship

```
Asset hasMany Inspections
Inspection belongsTo Asset
```

---

# Testing

Run tests

```
php artisan test
```

Tests cover

* Asset creation endpoint
* Asset retrieval endpoint
* Validation behaviour
* API response structure

---

# Example Test User

```
email: admin@test.com
password: password
```

---

# Author

Charles Hlongwane
