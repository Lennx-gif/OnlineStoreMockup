# Learning Project: Online Store with PHP, JavaScript, HTML and CSS

**Date:** 7 October 2026
**Goal:** Learn how every layer of a web application works by building a small store from scratch. This is **not** a production business solution.

---

## 1. Approach

| Decision | Choice | Reason |
|---|---|---|
| Framework | **None** (plain PHP) | You see how routing, sessions, security and database access really work. Frameworks hide these. |
| Database | MySQL/MariaDB with **PDO** | Teaches SQL and safe queries. |
| Front end | Hand-written HTML, CSS, vanilla JS | No React or CSS libraries, so the basics become solid. |
| Payments | **M-Pesa Daraja sandbox** (fake money) | Real payment flow, no risk. Optional, last milestone. |
| Hosting | Local only (XAMPP or Laragon) | No server setup needed. Deploy later if you wish. |
| Scope | One store, about 10 sample products, 2 user roles | Small enough to finish. |

### What to deliberately skip

Coupons, multiple shipping rates, tax rules, product variants, reviews, PDF invoices, email sending, image resizing, order tracking emails, and a staff role. They add time but little new learning. Add them later as stretch goals.

---

## 2. What You Will Learn From Each Language

| Language | Core skills practised |
|---|---|
| **HTML** | Semantic tags, forms, tables, accessibility basics |
| **CSS** | Flexbox, Grid, responsive design (media queries), CSS variables, component styling |
| **JavaScript** | DOM manipulation, events, `fetch()` and JSON, form validation, updating the page without reloading |
| **PHP** | Sessions, forms (`$_POST`/`$_GET`), PDO, password hashing, includes/templates, JSON responses, file uploads |
| **SQL** | Table design, primary/foreign keys, `JOIN`, `INSERT/UPDATE/DELETE`, transactions |
| **Security (cross-cutting)** | SQL injection, XSS, CSRF, session handling, never trusting client-side data |

---

## 3. Final Product (Minimum Version)

### Storefront
- Home page with product grid
- Product detail page
- Search by name and filter by category
- Cart (add, remove, change quantity)
- Register, login, logout
- Checkout that creates an order
- "My orders" page

### Admin (one admin account)
- Add, edit and delete products
- View orders and change their status

### Not included
Everything in the "skip" list above.

---

## 4. Folder Structure (Simplified)

```
mini-store/
├── public/
│   ├── index.php            # Product list
│   ├── product.php          # Product details
│   ├── cart.php
│   ├── checkout.php
│   ├── login.php
│   ├── register.php
│   ├── logout.php
│   ├── orders.php
│   ├── api/
│   │   ├── cart_add.php     # Called by JavaScript
│   │   └── cart_update.php
│   ├── admin/
│   │   ├── index.php
│   │   ├── product_form.php
│   │   └── orders.php
│   └── assets/
│       ├── css/style.css
│       ├── js/cart.js
│       └── img/
├── src/
│   ├── db.php               # PDO connection
│   ├── auth.php             # Login/session helpers
│   ├── csrf.php             # Token helpers
│   └── views/
│       ├── header.php
│       └── footer.php
├── database/
│   └── schema.sql
└── .env                     # Local DB credentials (not in Git)
```

Keep `src/` and `.env` outside the public folder as a habit, even locally.

---

## 5. Database (Five Tables Are Enough)

| Table | Columns |
|---|---|
| `users` | id, name, email (unique), password_hash, role |
| `products` | id, name, description, price, stock, image, category |
| `cart_items` | id, user_id, product_id, quantity |
| `orders` | id, user_id, total, status, created_at |
| `order_items` | id, order_id, product_id, unit_price, quantity |

**Concepts this teaches:** one-to-many relationships (a user has many orders), many-to-many through a link table (`order_items`), and why you store the price at purchase time.

---

## 6. Milestones (Learn in This Order)

Each milestone ends with something you can run and test. Do not move on until it works.

### Milestone 1: Static pages (HTML + CSS)
- Build the home, product, cart and login pages with fake data.
- Make them responsive (phone, tablet, desktop).
- **Check:** pages look right at 3 screen sizes.

### Milestone 2: Database and product list (PHP + SQL)
- Create the database, import `schema.sql`, insert 10 sample products.
- Connect with PDO and show products on `index.php` and `product.php`.
- **Check:** changing a row in the database changes the page.

### Milestone 3: Register and login (PHP sessions)
- Registration form with `password_hash()`; login with `password_verify()`.
- Protect pages that need login; add logout.
- **Check:** cannot open `orders.php` when logged out.

### Milestone 4: Cart (PHP + JavaScript)
- First build it with plain forms (page reloads).
- Then rebuild "add to cart" and "change quantity" with `fetch()` and JSON so the page updates without reloading.
- **Check:** the cart total updates instantly and is correct after a refresh.

### Milestone 5: Checkout and orders (SQL transactions)
- Convert the cart into an `orders` row plus `order_items`, reduce stock, empty the cart, all inside one transaction.
- Recalculate the total on the server, never from the browser.
- **Check:** if one step fails, nothing is saved.

### Milestone 6: Admin panel
- Admin-only pages to add, edit and delete products, and to update order status.
- Basic image upload with type and size checks.
- **Check:** a normal user cannot reach `/admin` even by typing the URL.

### Milestone 7: Security pass
- Go through section 7 line by line and test each attack yourself.
- **Check:** every item below is working.

### Milestone 8 (optional): M-Pesa sandbox payment
- Register on the Safaricom Daraja developer portal and use the sandbox.
- Send an STK Push request from PHP; receive the callback on a public URL (a tunnel tool such as ngrok is needed for this locally); mark the order as paid.
- **Check:** order status changes only after the callback, not after a button click.

### Stretch goals
Search filters, pagination, wishlist, product reviews, email on order (PHPMailer), then rebuild the same store in **Laravel** to compare what a framework gives you.

---

## 7. Security Practice List (Test Each One Yourself)

| Topic | What to do | How to test |
|---|---|---|
| SQL injection | Use PDO prepared statements everywhere | Try `' OR 1=1 --` in the login form |
| XSS | Wrap output in `htmlspecialchars()` | Register with the name `<script>alert(1)</script>` |
| CSRF | Hidden token in every POST form | Submit a form without the token; it should fail |
| Passwords | `password_hash()` / `password_verify()` | Check the database holds no readable passwords |
| Price tampering | Recalculate totals on the server | Edit the price in browser DevTools, then check out |
| Access control | Role check at the top of every admin page | Open an admin URL as a normal user |
| Uploads | Allow only image types, limit size, rename files | Try uploading a `.php` file |

This list is the most valuable part of the project. Most real-world shop breaches come from these basics.

---

## 8. Suggested Schedule

Assuming about 6-8 hours per week alongside your studies and other projects:

| Week | Focus |
|---|---|
| 1 | Milestone 1: static HTML/CSS pages |
| 2 | Milestone 2: database and product list |
| 3 | Milestone 3: register and login |
| 4-5 | Milestone 4: cart (plain, then with JavaScript) |
| 6 | Milestone 5: checkout and transactions |
| 7 | Milestone 6: admin panel |
| 8 | Milestone 7: security pass, README, screenshots |
| 9+ | Optional: M-Pesa sandbox, stretch goals |

---

## 9. Tools

- **Editor:** VS Code (with the PHP Intelephense extension)
- **Local server:** XAMPP or Laragon
- **Database viewer:** phpMyAdmin
- **Version control:** Git + GitHub (commit after every milestone)
- **Debugging:** browser DevTools (Network tab for `fetch()` calls), `var_dump()` / PHP error log
- **API testing:** Postman or Insomnia for the `api/` endpoints

---

## 10. Learning Outcomes Checklist

- [ ] I can explain the full journey of one request: browser, server, PHP, database, back to the browser
- [ ] I can write safe SQL with prepared statements and basic `JOIN` queries
- [ ] I can build a responsive layout with Flexbox and Grid
- [ ] I can call a PHP endpoint from JavaScript and update the page from JSON
- [ ] I understand sessions, password hashing and role-based access
- [ ] I can demonstrate and fix SQL injection, XSS and CSRF
- [ ] The project is on GitHub with a README and screenshots, ready for my portfolio

---

## 11. What Comes After

1. **Rebuild the same store in Laravel.** You will immediately see what routing, validation, authentication and an ORM save you.
2. **Rebuild the front end with a JavaScript framework** (React or Vue) that calls your PHP as a JSON API.
3. **Deploy it** on a free or cheap PHP host to learn HTTPS, environment variables and backups.
