# Marketplace Ongkir

Marketplace Ongkir is a Laravel 12-based e-commerce marketplace project that integrates with the RajaOngkir API to calculate shipping costs automatically. The app includes customer storefront, checkout flow, order management, admin dashboard, and shipping configuration panel.

Project title:
Implementation of Automatic Shipping Cost Checking using the RajaOngkir API on an E-Commerce Website

## Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL (XAMPP)
- Blade templates
- Vite + JavaScript
- Tailwind CSS via CDN for rapid UI styling
- Laravel Breeze authentication
- RajaOngkir API integration

## Folder Structure

```text
MarketplaceOngkir/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   ├── Api/
│   │   │   └── Customer/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   └── Services/
│       └── Shipping/
├── config/
│   └── rajaongkir.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   └── factories/
├── public/
│   └── build/
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
├── tests/
├── .env
├── .env.example
├── composer.json
├── package.json
├── README.md
├── vite.config.js
└── artisan
```

### Folder Notes

- app/Http/Controllers/Admin: admin actions for dashboard, products, categories, orders, reports, and settings.
- app/Http/Controllers/Customer: storefront pages, cart, checkout, profile, and order history.
- app/Http/Controllers/Api: JSON API endpoint used by the frontend to get shipping quotes.
- app/Services/Shipping: RajaOngkir API logic and fallback cost handling.
- config/rajaongkir.php: service configuration loaded from .env.
- resources/views/layouts: public and admin layouts.
- resources/views/partials: reusable header, navbar, footer, flash messages, and product cards.
- resources/views/pages: customer-facing pages.
- resources/views/admin: admin dashboards and management pages.
- database/seeders: default admin/customer users plus categories and sample products.

## Local Setup on XAMPP

Make sure Apache and MySQL are running in XAMPP, then follow these steps:

1. Open terminal in the project directory.
2. Run:

```bash
composer install
```

3. Create the database in phpMyAdmin:

- Database name: `marketplace_ongkir`
- Charset: `utf8mb4`
- Collation: `utf8mb4_unicode_ci`

4. Configure the environment:

```bash
cp .env.example .env
```

Then update `.env` with:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace_ongkir
DB_USERNAME=root
DB_PASSWORD=

APP_NAME="Marketplace Ongkir"
APP_URL=http://localhost

RAJAONGKIR_BASE_URL=https://pro.rajaongkir.com/api
RAJAONGKIR_API_KEY=your_rajaongkir_api_key
RAJAONGKIR_ORIGIN_ID=152
RAJAONGKIR_COURIERS=jne,pos,tiki
RAJAONGKIR_TIMEOUT=30
```

5. Generate the app key:

```bash
php artisan key:generate
```

6. Run migrations and seed data:

```bash
php artisan migrate --seed
```

7. Link storage if needed:

```bash
php artisan storage:link
```

8. Install frontend dependencies and run Vite:

```bash
npm install
npm run dev
```

9. Start the app:

```bash
php artisan serve
```

Then open:

- Customer site: http://localhost:8000
- Admin dashboard: http://localhost:8000/admin

## Default Login Accounts

After seeding the database:

- Admin: admin@marketplaceongkir.test / password123
- Customer: customer@marketplaceongkir.test / password123

## RajaOngkir API Notes

This project is designed to consume the RajaOngkir Komerce V2 API. The service class is located in:

- app/Services/Shipping/RajaOngkirService.php

The app includes a demo fallback mechanism so the checkout and shipping simulation still work even when no valid API key is configured yet.

## Important Notes

- The shipping cost is not manually calculated; it is requested through the RajaOngkir API from the checkout flow.
- The project is organized to support easy explanation and defense in a final-year course assignment.
- The codebase is intentionally split between customer-facing and admin-facing parts for clarity and maintainability.

## License

MIT License.
