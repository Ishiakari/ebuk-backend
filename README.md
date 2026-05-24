# eBuk Backend (Laravel API)

This is the backend API for the eBuk mobile application. It handles book metadata, cover images, and document uploads.

## Prerequisites
- PHP 8.1+
- Composer
- MySQL or SQLite

## Setup Instructions

**1. Clone the repository and install dependencies**
```bash
git clone <repository-url>
cd ebuk-backend
composer install
```

**2. Configure Environment Variables**
Copy the example `.env` file and set up your database credentials:
```bash
cp .env.example .env
php artisan key:generate
```
*Make sure to configure your `DB_CONNECTION`, `DB_DATABASE`, etc., in the `.env` file.*

**3. Run Database Migrations & Seeders**
This will create the necessary tables including `books`, `authors`, `genres`, and statuses.
```bash
php artisan migrate
```
*(Optional)* If you have seeders set up, you can run `php artisan db:seed` to populate test data.

**4. Create the Storage Link (CRITICAL)**
We use local storage for book covers and uploaded documents (PDF/EPUB). You **must** create the symbolic link so the mobile app can access them:
```bash
php artisan storage:link
```

**5. Start the Server**
To ensure your mobile app can communicate with the backend on your local Wi-Fi network, start the server bound to all IP addresses:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```
*(Note: Your machine's local IP address will be the one used in the mobile app's config).*
