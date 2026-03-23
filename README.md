# Assignment : Assignment-04

### Name : Ali Nishu

### Email : nishu.ptg@gmail.com

---

## About
A secure RESTful URL Shortener API built with Laravel and Sanctum.

## Features
- Token-based authentication (register, login, logout)
- User profile management (view, update, delete)
- URL shortening with auto-generated short codes
- Click tracking on every redirect
- Optional expiration date support
- Ownership-based authorization via Eloquent Policies

## Tech Stack
- Laravel 13
- Laravel Sanctum
- MySQL

## Setup
```bash
git clone https://github.com/nishu-ptg/ic-b4-assignment4
cd ic-b4-assignment4
composer install
cp .env.example .env
php artisan key:generate
# configure DB in .env
php artisan migrate
php artisan serve
```

## API Endpoints

### Auth
| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | `/api/register` | Register new user |
| POST | `/api/login` | Login and get token |
| POST | `/api/logout` | Revoke token |

### User Profile
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/user` | View profile |
| PUT/PATCH | `/api/user` | Update profile |
| DELETE | `/api/user` | Delete account |

### URLs
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/urls` | List all URLs |
| POST | `/api/urls` | Create short URL |
| GET | `/api/urls/{id}` | View URL |
| PUT/PATCH | `/api/urls/{id}` | Update URL |
| DELETE | `/api/urls/{id}` | Delete URL |

### Public
| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/{shortCode}` | Redirect to original URL |

