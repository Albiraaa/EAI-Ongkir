# Marketplace Ongkir

Marketplace Ongkir is a Laravel 12 e-commerce marketplace project built for automatic shipping cost checking using RajaOngkir. It includes a storefront, customer authentication, cart flow, checkout, admin dashboard, product/category management, customer management, and local image storage handling.

Project title:
Implementation of Automatic Shipping Cost Checking using the RajaOngkir API on an E-Commerce Website

## Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL via XAMPP
- Blade templates
- Vite
- Tailwind CSS
- Laravel Breeze authentication
- Redis or file-based storage is not required for the core flow
- RajaOngkir API integration

## Main Features

### Customer features
- Public homepage with featured products and category highlights
- Product listing and product detail pages
- Login and register pages with proper role-based navigation
- Customer cart with add, update, and remove actions
- Checkout flow for authenticated customers
- Order history and order detail pages
- User profile page
- Automatic shipping cost checking through RajaOngkir

### Admin features
- Admin dashboard with summary metrics
- Product CRUD with image upload and local storage handling
- Category CRUD with image upload and local storage handling
- Customer management page for viewing users, editing roles, and deleting accounts
- Role-based middleware to separate admin and customer access
- Management storage page to view all uploaded local files, upload new images, and delete existing ones
- Product/category image removal without deleting the data record itself

### Image handling
- Product and category images are stored locally in the public disk
- Uploaded files are kept in the storage folder and linked publicly with `php artisan storage:link`
- Admin can upload, replace, and delete image files from edit screens and the dedicated storage management page
- Image watermarking is applied in the backend image-save flow for uploaded files

## Project Structure

```text
EAI/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Api/
│   │   │   ├── Auth/
│   │   │   └── Customer/
│   │   ├── Middleware/
│   │   ├── Requests/
│   │   └── Resources/
│   ├── Models/
│   ├── Support/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── layouts/
│       ├── pages/
│       └── partials/
├── routes/
│   ├── auth.php
│   └── web.php
├── storage/
├── tests/
│   └── Feature/
├── .env.example
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── README.md
├── vite.config.js
└── .gitignore
```

## Local Setup on XAMPP

1. Start Apache and MySQL in XAMPP.
2. Open a terminal in the project folder.
3. Install PHP dependencies:

```bash
composer install
```

4. Create a MySQL database in phpMyAdmin:

- Database name: `marketplace_ongkir`
- Charset: `utf8mb4`
- Collation: `utf8mb4_unicode_ci`

5. Copy the environment file:

```bash
copy .env.example .env
```

6. Update `.env` with your local database and app settings:

```env
APP_NAME="Marketplace Ongkir"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_ongkir
DB_USERNAME=root
DB_PASSWORD=

RAJAONGKIR_BASE_URL=https://pro.rajaongkir.com/api
RAJAONGKIR_API_KEY=your_rajaongkir_api_key
RAJAONGKIR_ORIGIN_ID=152
RAJAONGKIR_COURIERS=jne,pos,tiki
RAJAONGKIR_TIMEOUT=30
```

7. Generate the application key:

```bash
php artisan key:generate
```

8. Run the database migrations and seeders:

```bash
php artisan migrate --seed
```

9. Link storage for local image files:

```bash
php artisan storage:link
```

10. Install frontend dependencies:

```bash
npm install
```

11. Run Vite in development mode:

```bash
npm run dev
```

12. Start the Laravel app:

```bash
php artisan serve
```

Then open:

- Customer storefront: `http://localhost:8000`
- Admin panel: `http://localhost:8000/admin`

## Default Login Accounts

After running the seeders, you can log in with:

- Admin:
  - Email: `admin@marketplaceongkir.test`
  - Password: `password123`
- Customer:
  - Email: `customer@marketplaceongkir.test`
  - Password: `password123`

## Admin Access Notes

- Normal users are redirected to the storefront after login/register.
- Admin users are redirected to the admin dashboard.
- There is middleware protection for admin routes.
- The admin can manage products, categories, customer roles, and local uploaded image files.

## RajaOngkir Integration

This project is designed to request shipping cost data using the RajaOngkir API during checkout. The shipping logic is connected to the storefront checkout flow and returns shipping options such as JNE, POS, and TIKI when the API key and origin data are configured.

## Storage Management

The project includes a dedicated admin page for local file management:

- `admin/storage`

From this page, the admin can:
- view uploaded local image files
- upload new images
- delete existing images from the public storage disk

This page is useful for managing product and category images without always going through the model edit form.

## Testing

This project includes feature tests for:
- authentication flow
- admin category management
- product image upload and removal
- customer management
- storage management

Run tests with:

```bash
php artisan test
```

Or a focused filter:

```bash
php artisan test --filter='StorageManagementTest|CategoryManagementTest|ProductImageUploadTest|UserManagementTest|AuthenticationTest'
```

## Notes

- This project uses a local image storage approach instead of external image URLs for uploaded product/category images.
- The app is structured for a course or portfolio project and is organized into customer-facing and admin-facing modules.
- The watermarked backend image process is applied when files are saved to storage to identify uploaded assets as part of the project brand.

## License

MIT License.
