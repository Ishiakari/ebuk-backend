# EBUK - Personal Book List API (Backend)

The **EBUK Backend** is a lightweight, decoupled RESTful API built using Laravel. It handles raw data transactions, relational data persistence, and integrity validations for a standalone, single-user mobile application. It utilizes a fully normalized relational schema to catalog books without requiring global user authorization layers.

---

## Tech Stack & Architecture

- **Framework:** Laravel 11.x (PHP 8.2+)
- **Database:** MySQL / PostgreSQL (3rd Normal Form Architecture)
- **API Design:** REST Architecture returning JSON responses
- **Frontend Companion:** React Native (Managed via independent repository)

---

## 📊 Database Normalization Schema

To eliminate structural redundancy and preserve high data integrity, the system layout segregates text constraints into dynamic numerical entities linked through explicit Foreign Keys.

```text
  [ authors ]  ───( 1-to-Many )───► [ books ]
  [ genres ]   ───( 1-to-Many )───►    ▲
  [ statuses ] ───( 1-to-Many )───► ───┘
```
