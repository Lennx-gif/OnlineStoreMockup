# Mini Store

A learning-first online shop built with plain PHP 8.1+, MySQL/MariaDB, HTML, CSS, and vanilla JavaScript. It follows the supplied Mini Store mockups and keeps application code, database credentials, and uploaded images outside the public web root. This is a local learning project, not a ready-to-launch production commerce system.

## Included

- Responsive product catalogue with search, category filters, sorting, and pagination
- Product details and a session-based cart, enhanced with `fetch()` when JavaScript is enabled
- Registration, login, logout, checkout, order history, and admin-only product/order management
- PDO prepared statements, escaped output, CSRF-protected forms, hashed passwords, secure session cookie flags, server-side stock/price checks, and transactional checkout
- Private image uploads served through a constrained image endpoint

Payments are intentionally not connected: checkout creates a local learning order and never collects money.

## Run locally

1. Install PHP 8.1+ with PDO MySQL, Fileinfo, and mbstring, plus MySQL/MariaDB. XAMPP or Laragon are suitable for learning.
2. Copy `.env.example` to `.env` and set database credentials (in PowerShell: `Copy-Item .env.example .env`). The app reads this file itself; never put real secrets in a public directory or commit `.env`.
3. Import `database/schema.sql`, then import `database/seed.sql`:

   ```powershell
   Get-Content .\database\schema.sql | mysql -u root -p
   Get-Content .\database\seed.sql | mysql -u root -p online_store
   ```

   You can also run both scripts from phpMyAdmin or another MySQL client.
4. Create an administrator interactively:

   ```powershell
   php database/create_admin.php
   ```

   Use a unique password of at least 10 characters. This script refuses web requests and stores only a password hash.
5. Configure Apache's document root to the project's `public` directory. For a quick local PHP server from the project root, use:

   ```powershell
   php -S 127.0.0.1:8000 -t public
   ```
6. Open `http://127.0.0.1:8000`. Set `APP_DEBUG=0` outside local development and use HTTPS before exposing any deployment.

The default database settings target the common local XAMPP setup (`online_store`, user `root`, blank password); override them in `.env` for your machine.

## Project map

```text
public/       Web-accessible pages, assets, and JSON endpoint
src/          Database, session/auth helpers, and shared views
database/     Schema, sample catalogue, and CLI admin setup
storage/      Private product image uploads and log location
```

Only `public/` should be served by Apache/Nginx. Do not configure the project root as the document root.

## Learning notes and next steps

- Cart contents are kept in the browser's PHP session, so a guest cart is local to that browser session.
- Delivery is captured for the example order flow; shipping rates, taxes, coupons, email, password reset, and payments are intentionally omitted.
- `order_items` snapshots product name and unit price so later catalogue edits do not rewrite order history.
- Before a real launch, use a maintained framework such as Laravel or have the application security-reviewed; add HTTPS, payment-provider server verification, rate limiting, privacy/compliance work, backups, monitoring, and automated tests.

The original implementation and learning plans plus `Mini Store Mockups.pdf` remain alongside this app as project references.
