# Online Store Implementation Plan: PHP, JavaScript, HTML and CSS

**Date:** 7 October 2026
**Verdict:** Yes, it is possible. This stack (often with MySQL as the database) runs a large share of the small and medium web stores in the world. WordPress/WooCommerce, Magento and OpenCart are all built on PHP.

---

## 1. Feasibility Summary

| Question | Answer |
|---|---|
| Can the four languages build a complete store? | Yes, with one addition: a **database** (MySQL/MariaDB). The four languages alone cannot store products, users or orders. |
| Is it suitable for a real business? | Yes, for small to medium traffic, if security and payments are done carefully. |
| Is it the best choice for every case? | No. See section 10 for limits and alternatives. |

**Required extras (not languages, but needed):**

- **SQL** for the database (MySQL or MariaDB).
- **A web server** (Apache or Nginx) with PHP enabled.
- **HTTPS** (an SSL certificate) for any page that handles logins or payments.
- **A payment provider** (see section 7).

---

## 2. What Each Language Does

### HTML: Structure (what is on the page)

- Defines the content: product lists, images, forms, buttons, navigation.
- Uses semantic tags (`<header>`, `<main>`, `<nav>`, `<footer>`) for accessibility and SEO.
- Builds the forms for sign-up, login, checkout and admin product entry.
- In this project it is usually written inside `.php` files so PHP can insert live data (for example, a product name from the database).

### CSS: Presentation (how the page looks)

- Colours, fonts, spacing, layout and the store's brand identity.
- **Flexbox and Grid** for product grids and page layout.
- **Media queries** for responsive design. Most shoppers use phones, so design mobile-first.
- Visual states: hover effects, button styles, "out of stock" labels, form error colours.

### JavaScript: Behaviour in the browser (what happens without reloading)

- **Cart interactions:** add, remove and change quantity, and update the total instantly.
- **Form validation** before sending (friendly messages, not security).
- **AJAX / Fetch API:** talks to PHP in the background (live search, "add to cart" without a page reload, stock checks).
- **UI features:** image galleries, filters, sort menus, modals, mobile menu.
- **Important:** JavaScript runs on the user's device, so it can be changed by the user. It must never be the only check for prices, stock or permissions.

### PHP: Server logic (what happens on the server)

- Connects to the database and reads or writes data (products, users, orders).
- **Authentication:** registration, login, sessions, password hashing, roles (customer and admin).
- **Business rules:** the real price calculation, stock control, discount codes, tax and shipping.
- **Checkout and payments:** creates orders, calls the payment provider's API, handles payment confirmation callbacks (webhooks).
- **Security enforcement:** validates every input again, protects against attacks (section 8).
- **Output:** sends HTML pages and JSON responses to the browser.
- **Extras:** sends order emails, generates invoices (PDF), handles image uploads.

### SQL (MySQL): Data storage (what is remembered)

- Stores users, products, categories, carts, orders and payments permanently.
- Relationships between tables keep the data consistent (for example, an order belongs to a user).

### How they work together (one request)

1. The browser asks for `/product.php?id=12`.
2. **PHP** reads product 12 from **MySQL**.
3. PHP builds the **HTML** page, linked to **CSS** and **JS** files.
4. The user clicks "Add to cart". **JS** sends a background request to `/api/cart_add.php`.
5. **PHP** checks the product and stock, updates the cart in the database, and returns JSON.
6. **JS** updates the cart counter on the page.

---

## 3. System Architecture

```
┌────────────────────┐        HTTPS         ┌───────────────────────────┐
│  Browser (client)  │ ───────────────────▶ │  Web server (Apache/Nginx)│
│  HTML + CSS + JS   │ ◀─────────────────── │  + PHP 8.x                │
└────────────────────┘     HTML / JSON      └─────────────┬─────────────┘
                                                          │ SQL (PDO)
                                          ┌───────────────┴─────────────┐
                                          │  MySQL / MariaDB database   │
                                          └───────────────┬─────────────┘
                                                          │ API calls
                                          ┌───────────────┴─────────────┐
                                          │ Payment provider, email,    │
                                          │ shipping APIs (external)    │
                                          └─────────────────────────────┘
```

**Pattern:** a simple MVC-style separation (Model = database code, View = HTML templates, Controller = PHP page logic). This keeps the project readable and easier to maintain.

---

## 4. Full Structure Breakdown of the Final Product

### 4.1 Customer-facing (storefront)

| Module | Features |
|---|---|
| Home page | Banner, featured products, categories, new arrivals |
| Catalogue | Product grid, pagination, category pages |
| Search and filters | Keyword search, price range, category, sort (price, newest) |
| Product page | Images, description, price, stock status, add to cart, related products |
| Cart | Edit quantities, remove items, subtotal, discount code |
| Checkout | Address, delivery option, payment, order summary |
| Account | Register, login, logout, password reset, order history, saved addresses |
| Order tracking | Status per order (pending, paid, shipped, delivered) |
| Static pages | About, contact, delivery policy, returns, privacy policy, terms |

### 4.2 Admin panel (back office)

| Module | Features |
|---|---|
| Dashboard | Sales today/week/month, low-stock alerts, recent orders |
| Products | Add, edit, delete, upload images, set price and stock |
| Categories | Create and organise categories |
| Orders | View, update status, print invoice or packing slip |
| Customers | List, view order history, disable accounts |
| Coupons | Create discount codes with limits and expiry |
| Settings | Store name, currency, shipping rates, tax, payment keys |
| Roles | Admin, staff (restricted permissions) |

### 4.3 Backend services

- Authentication and session management
- Cart and order service
- Payment service (create payment, verify callback)
- Email service (order confirmation, password reset)
- Image upload and resize service
- Logging (errors, payments, admin actions)

---

## 5. Project Folder Structure

```
store/
├── public/                     # Only this folder is exposed to the web
│   ├── index.php               # Front controller / home page
│   ├── product.php
│   ├── cart.php
│   ├── checkout.php
│   ├── account/
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── orders.php
│   │   └── logout.php
│   ├── api/                    # JSON endpoints used by JavaScript
│   │   ├── cart_add.php
│   │   ├── cart_update.php
│   │   ├── search.php
│   │   └── payment_callback.php
│   ├── admin/
│   │   ├── index.php
│   │   ├── products.php
│   │   ├── orders.php
│   │   └── ...
│   └── assets/
│       ├── css/
│       │   ├── base.css        # Reset, variables, typography
│       │   ├── layout.css      # Grid, header, footer
│       │   ├── components.css  # Buttons, cards, forms
│       │   └── pages.css       # Page-specific styles
│       ├── js/
│       │   ├── cart.js
│       │   ├── search.js
│       │   ├── checkout.js
│       │   └── ui.js
│       └── img/
│           └── products/
├── src/                        # Private PHP code (not web accessible)
│   ├── config/
│   │   ├── config.php          # Settings (reads secrets from .env)
│   │   └── database.php        # PDO connection
│   ├── models/
│   │   ├── Product.php
│   │   ├── User.php
│   │   ├── Cart.php
│   │   └── Order.php
│   ├── services/
│   │   ├── PaymentService.php
│   │   ├── MailService.php
│   │   └── Auth.php
│   ├── helpers/
│   │   ├── csrf.php
│   │   ├── validate.php
│   │   └── format.php
│   └── views/                  # Reusable HTML templates
│       ├── header.php
│       ├── footer.php
│       └── product_card.php
├── storage/
│   ├── logs/
│   └── uploads/
├── database/
│   ├── schema.sql              # Table definitions
│   └── seed.sql                # Sample data
├── .env                        # Secrets (never committed to Git)
├── .htaccess                   # URL rules, security headers
└── README.md
```

**Why this layout:** only `public/` is reachable from the internet. Configuration, database code and secrets stay outside the web root, which prevents many accidental leaks.

---

## 6. Database Design (Core Tables)

| Table | Key columns |
|---|---|
| `users` | id, name, email (unique), password_hash, role, created_at |
| `categories` | id, name, slug, parent_id |
| `products` | id, category_id, name, slug, description, price, stock, image, is_active |
| `product_images` | id, product_id, path, sort_order |
| `carts` | id, user_id (nullable), session_id, created_at |
| `cart_items` | id, cart_id, product_id, quantity |
| `orders` | id, user_id, total, status, payment_status, shipping_address, created_at |
| `order_items` | id, order_id, product_id, unit_price, quantity |
| `payments` | id, order_id, provider, reference, amount, status, raw_response |
| `coupons` | id, code, type, value, min_total, expires_at, usage_limit |
| `addresses` | id, user_id, line1, city, phone, is_default |

**Rules:**

- Store the **price at the time of purchase** in `order_items`, so later price changes do not alter old orders.
- Use **foreign keys** and **indexes** on `email`, `slug`, `category_id`.
- Use **transactions** when creating an order and reducing stock, so both succeed or both fail.

---

## 7. Payments

Never handle raw card numbers yourself. Use a hosted checkout or an official payment API, so the provider handles the sensitive data.

| Option | Notes |
|---|---|
| **M-Pesa (Safaricom Daraja API, STK Push)** | Most relevant for Kenyan customers. PHP sends the request, the customer approves on their phone, and Safaricom calls your callback URL with the result. |
| **Card payments (Stripe, Flutterwave, Paystack, DPO)** | Hosted payment page or JS widget. PHP verifies the result by webhook. |
| **Cash on delivery** | Simple to build; needs good order-status handling. |

**Always:** confirm payment on the **server** through the provider's callback or a verification call. Never trust a "payment successful" message sent from the browser.

---

## 8. Security Checklist (Mandatory)

| Risk | Protection in PHP/JS/HTML |
|---|---|
| SQL injection | Use **PDO prepared statements** for every query. |
| Cross-site scripting (XSS) | Escape all output with `htmlspecialchars()`. |
| CSRF | CSRF token in every form and AJAX request. |
| Weak passwords | `password_hash()` / `password_verify()`; never store plain text. |
| Session theft | Secure, HttpOnly, SameSite cookies; regenerate session ID on login. |
| Price tampering | Always recalculate prices and totals on the server. |
| Malicious uploads | Check file type and size, rename files, store outside executable paths. |
| Brute-force login | Rate limiting and temporary lockouts. |
| Data exposure | HTTPS everywhere, `.env` for secrets, `display_errors` off in production. |
| Admin access | Role checks on every admin page, not just a hidden link. |
| Payment fraud | Verify webhooks (signature or reference check) before marking orders as paid. |

Also follow the **Kenya Data Protection Act, 2019** if you store customer personal data (privacy policy, consent, secure storage).

---

## 9. Implementation Phases

| Phase | Work | Output | Estimate* |
|---|---|---|---|
| 1. Planning | Define products, pages, user flows, wireframes | Wireframes, feature list | 1 week |
| 2. Setup | Local environment (XAMPP/Laragon or Docker), Git repo, folder structure, database schema | Running empty project | 2-3 days |
| 3. Front-end base | HTML templates, CSS system, responsive layout | Static store pages | 1-2 weeks |
| 4. Catalogue | PHP + SQL for products and categories, search and filters | Browsable store | 1 week |
| 5. Accounts | Registration, login, sessions, password reset | User system | 1 week |
| 6. Cart | PHP cart logic + JS interactions (AJAX) | Working cart | 1 week |
| 7. Checkout and payments | Order creation, M-Pesa/card integration, webhooks, emails | Paid orders | 1-2 weeks |
| 8. Admin panel | Product, order and coupon management | Back office | 2 weeks |
| 9. Security and testing | Security review, input tests, payment sandbox tests, mobile tests | Test report | 1 week |
| 10. Deployment | Hosting, HTTPS, backups, monitoring | Live store | 2-3 days |
| 11. Maintenance | Updates, backups, bug fixes, analytics | Ongoing | Ongoing |

*Rough estimates for one developer working part-time alongside studies; adjust to your available hours.

### Suggested tools

- **Editor:** VS Code
- **Local server:** XAMPP, Laragon, or Docker
- **Version control:** Git + GitHub
- **Database tool:** phpMyAdmin or DBeaver
- **Testing:** browser DevTools, Postman (API endpoints), PHPUnit (optional)
- **Hosting:** shared hosting with PHP/MySQL, or a small VPS

---

## 10. Limits of This Approach, and Alternatives

### Where this stack struggles

- **Everything is manual.** Security, carts, tax, SEO and emails all have to be built and maintained by you. Mistakes here cost money.
- **Scaling.** Very high traffic needs caching, queues and load balancing, which plain PHP projects do not include by default.
- **Plain PHP can become messy** as the code grows without a framework's structure.
- **Payment compliance and security** carry real responsibility when you build the checkout yourself.
- **Time.** A secure custom store takes longer than configuring an existing platform.

### Alternative designs

| Approach | When to choose it |
|---|---|
| **PHP + framework (Laravel)** | Same language, but with built-in routing, authentication, validation, CSRF and ORM. The best upgrade path for this plan. |
| **WordPress + WooCommerce** | Fastest launch with thousands of plugins, including M-Pesa. Good when speed matters more than custom code. |
| **Shopify / hosted platform** | Lowest maintenance; payments, security and hosting included. Monthly fees and less control. |
| **JavaScript full-stack (Node.js + Express + React/Next.js)** | One language across the whole project; strong for highly interactive stores and APIs. |
| **Headless commerce (e.g. Medusa, Saleor, Strapi) + a JS front end** | Flexible, modern architecture; best when you need a mobile app and a website on one backend. |
| **Python (Django/Saleor)** | Strong built-in admin and security defaults. |

### Recommendation

Build the **plain PHP + JS + HTML + CSS version first** if the goal is learning and a portfolio project, since it teaches every layer. If the goal is a real business with real customers, use the same structure but move to **Laravel**, or launch on **WooCommerce** while you build custom features gradually.

---

## 11. Definition of Done (Final Product Checklist)

- [ ] Customers can browse, search, add to cart, check out and pay
- [ ] Payment is confirmed by server-side verification only
- [ ] Orders and stock update correctly, with transactions
- [ ] Admin can manage products, orders and coupons
- [ ] All forms use CSRF tokens and prepared statements
- [ ] Site works on mobile, tablet and desktop
- [ ] HTTPS is active and secrets are outside the web root
- [ ] Automatic database backups are running
- [ ] Privacy policy, terms and returns policy are published
- [ ] Order and password-reset emails are tested
