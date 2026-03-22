**Assignment \-04 \[ URL Shortener API  \]**

## Task . 100 marks (Pass Marks: 40\)

# This project focuses on building a secure RESTful URL Shortener API using Laravel Sanctum.

The goal is to demonstrate strong understanding of:

* Token-based API authentication  
* RESTful API architecture  
* CRUD operations  
* Authorization & ownership control  
* Secure URL generation logic

---

# **1️⃣ Authentication Module (Laravel Sanctum)**

The system must implement **Token-Based Authentication** using Laravel Sanctum.

All authentication endpoints must:

* Return JSON responses only  
* Follow proper HTTP status codes  
* Generate and manage API tokens correctly

---

## **1.1 Register**

**Fields Required**

* name  
* email  
* password  
* password\_confirmation

**Validation Rules**

* Email must be unique  
* Password must be at least 8 characters  
* Password confirmation must match

**Expected Behavior**

* Create a new user  
* Generate and return a Plain Text API Token  
* Return `201 Created`

---

## **1.2 Login**

**Fields Required**

* email  
* password

**Validation Rules**

* Credentials must be valid

**Expected Behavior**

* Return a valid API token  
* Return `401 Unauthorized` if credentials are incorrect

---

## **1.3 Logout**

**Access**

* Must be an authenticated request

**Expected Behavior**

* Revoke/delete the current access token  
* Return `204 No Content`

---

# **2️⃣ User & Profile Management**

All routes must be protected using `auth:sanctum`.

These endpoints allow authenticated users to manage their own account.

| Feature | Method | Endpoint | Description |
| ----- | ----- | ----- | ----- |
| View Profile | GET | `/api/user` | Return authenticated user details |
| Update Profile | PUT / PATCH | `/api/user` | Update name or email |
| Delete Account | DELETE | `/api/user` | Delete user and all associated shortened URLs |

## **Requirements**

* Users can only access their own profile  
* Deleting a user must also delete all related shortened URLs  
* Proper status codes must be used

---

# **3️⃣ URL Shortener Management (Core Feature)**

Each shortened URL must belong to a specific user.  
 Users must only access their own URLs.

---

## **3.1 Data Structure**

Each shortened URL must contain:

* id (Primary Key)  
* user\_id (Foreign Key → users table)  
* original\_url (Required, valid URL format)  
* short\_code (Unique string, auto-generated)  
* clicks (Integer, default: 0\)  
* expires\_at (Optional datetime)  
* created\_at  
* updated\_at

---

## **3.2 Core Endpoints**

| Action | Method | Endpoint | Description |
| ----- | ----- | ----- | ----- |
| List URLs | GET | `/api/urls` | Paginated list of user’s shortened URLs |
| Create Short URL | POST | `/api/urls` | Generate a new short URL |
| View URL | GET | `/api/urls/{id}` | View specific URL (403 if unauthorized) |
| Update URL | PUT | `/api/urls/{id}` | Update original URL or expiration |
| Delete URL | DELETE | `/api/urls/{id}` | Delete a shortened URL |

---

## **3.3 Public Redirection Endpoint**

This endpoint does **not require authentication**.

| Action | Method | Endpoint | Description |
| ----- | ----- | ----- | ----- |
| Redirect | GET | `/{short_code}` | Redirect to original URL |

### **Redirection Rules**

* If short code exists → Redirect (302 Found)  
* Increment `clicks` counter  
* If expired → Return 410 Gone  
* If not found → Return 404 Not Found

---

# **4️⃣ Functional Requirements**

* Short codes must be unique  
* Short codes should be auto-generated (random string or hash-based)  
* Validate original URL format  
* Support optional expiration date  
* Click counter must increment on every successful redirect  
* Users must not access or modify other users’ URLs

---

# **5️⃣ Technical & Security Requirements**

To achieve full marks, the following must be properly implemented:

---

## **5.1 Middleware Protection**

* Wrap all User and URL management routes inside `auth:sanctum`  
* Public redirect route must remain accessible without authentication

---

## **5.2 Authorization Layer**

* Use Eloquent Policies or Gates  
* Ensure User A cannot edit/delete User B’s shortened URLs

নির্দেশনাঃ

১। ভালো করে অ্যাসাইনমেন্টের নির্দেশনা গুলো পড়ুন।

২। এরপরেও যদি অ্যাসাইনমেন্ট সম্পর্কিত কোন প্রশ্ন থাকে তাহলে অবশ্যই সাপোর্টে এসে কথা বলবেন

৩। অ্যাসাইনমেন্টের মার্কস ১০০ (পাস মার্কস ৪০)

৪। এসাইনমেন্ট জমা দেওয়ার শেষ তারিখ (21 মার্চ 2026\) রাত 11.59 মিনিট পর্যন্ত ।)

৫। এসাইনমেন্ট জমা দেওয়ার শেষ তারিখ অতিক্রম হবার পর জমা দিলে ৫০% মার্কস কর্তন হবে

৬। অ্যাসাইনমেন্ট এর সমস্ত সোর্স কোড গিটহাব এ আপলোড করতে হবে এবং readme.md file এ নিচের তথ্যগুলো প্রদান করতে হবে

প্রজেক্ট এর root ডিরেক্টরীতে একটি readme.md file তৈরি করুন

তারপর রেডমি ফাইলে নিচের দেওয়া তথ্য গুলো লিখুন

\# Assignment : কত নাম্বার এসাইনমেন্ট তা লিখুন

\#\#\# Name : আপনার নাম লিখুন

\#\#\# Email: (আপনার জিমেইল এড্রেস লিখুন যে যে জিমেইল দিয়ে আপনি কোর্স purchase করেছেন)

পুন:রায় গিটহাব এ readme ফাইল সহ কোড গুলো পুশ করুন

৭। এসাইনমেন্টের গিটহাব রিপোজিটরিটির লিংক কপি করুন এবং সেটি ওয়েবসাইটে জমা দিন ( গিটহাব রিপোজিটরিটি অবশ্যই পাবলিক থাকতে হবে)