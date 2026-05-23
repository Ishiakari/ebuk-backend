# EBUK - Personal Book List API (Backend)

The **EBUK Backend** is a lightweight, decoupled RESTful API built using Laravel. It handles raw data transactions, relational data persistence, and integrity validations for a standalone, single-user mobile application. It utilizes a fully normalized relational schema to catalog books without requiring global user authorization layers.

---

## Tech Stack & Architecture

- **Framework:** Laravel 11.x (PHP 8.2+)
- **Database:** MySQL / PostgreSQL (3rd Normal Form Architecture)
- **API Design:** REST Architecture returning JSON responses
- **Frontend Companion:** React Native (Managed via independent repository)

---

## Database Normalization Schema

To eliminate structural redundancy and preserve high data integrity, the system layout segregates text constraints into dynamic numerical entities linked through explicit Foreign Keys.

```text
  [ authors ]  ───( 1-to-Many )───► [ books ]
  [ genres ]   ───( 1-to-Many )───►    ▲
  [ statuses ] ───( 1-to-Many )───► ───┘
```

Table Structure
authors: Stores unique author definitions (id, name).

genres: Maps unique classification items (id, name).

statuses: Dictates structural progress markers (id, name) -> e.g., "Plan to Read", "Reading", "Completed".

books: Relational ledger tracking the metadata pointers (title, year, author_id, genre_id, status_id).

| Method | Endpoint | Description | CRUD Mapping |
| :--- | :--- | :--- | :--- |
| **GET** | `/api/books` | Fetches all books with relational metadata joins | Read |
| **POST** | `/api/books` | Validates and commits a new book entry | Create |
| **PUT** | `/api/books/{id}` | Updates field properties of a specific record ID | Update |
| **DELETE** | `/api/books/{id}` | Completely purges a book index from the schema | Delete |

# Local Installation & Setup Guide

Because the architecture uses a decoupled structure, you must configure and host both applications simultaneously on your local workstation.

## Part 1: Laravel Backend Setup

### 1. Install Dependencies
Navigate to your backend repository folder and install PHP dependencies:

```bash
cd ebuk-backend
composer install
```
### 2. Initialize Environment Configuration
Create your environment configuration file and generate the application key:
