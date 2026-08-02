# Egypt High School Results API

RESTful API built with Laravel.

---

## Technologies

- Laravel 12
- PHP 8.2
- MySQL
- Eloquent ORM

---

## Features

- Search by seat number
- Search by Arabic full name
- Arabic normalization
- Request validation
- Arabic validation messages
- JSON API responses
- Exception handling

---

## API Endpoint

```
GET /api/students/search
```

### Search by seat number

```
/api/students/search?seating_no=123456
```

### Search by Arabic name

```
/api/students/search?arabic_name=أحمد محمد أحمد علي
```

---

## Validation

Supports:

- Arabic names
- Trim spaces
- Multiple spaces normalization
- Arabic digit normalization

---

## Installation

```bash
composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve
```

---

## Author

Karim Galal
