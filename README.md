# SDC310L – PHP MVC Shopping Cart Application

## Project Overview

This project is a PHP-based web application developed using the Model-View-Controller (MVC) architecture. The application allows users to browse products from a database, add items to a shopping cart, update quantities, remove items, clear the cart, and complete a checkout process.

The purpose of this project was to demonstrate structured application design, database integration, session management, and final testing verification.

---

## Application Features

- Product catalog retrieved from MySQL database
- Add products to cart
- Update product quantities
- Remove individual products
- Clear entire cart
- Subtotal calculation
- Tax calculation (5%)
- Shipping and handling calculation (10%)
- Grand total calculation
- Checkout functionality
- One-time confirmation popup message after checkout
- Clean MVC routing structure

---

## Architecture

The application follows MVC structure:

- **Models** – Handle database interaction
- **Views** – Handle UI display
- **Controllers** – Manage application logic and routing
- **index.php** – Front controller for routing requests

Session variables are used to manage cart state.

---

## How to Run the Application

1. Place the project folder inside:

C:\xampp\htdocs\

2. Start Apache and MySQL using XAMPP.
3. Import the provided SQL database file into phpMyAdmin.
4. Open a browser and navigate to:

http://localhost/sdc310l_project/index.php

---

## Testing Summary

The following functional tests were performed:

### TC-01: Catalog Display
- Verified products load from database.
- Result: Pass

### TC-02: Add to Cart
- Verified items are added and cart count updates.
- Result: Pass

### TC-03: Update Quantity
- Verified quantity changes recalculate totals correctly.
- Result: Pass

### TC-04: Remove Item
- Verified selected product is removed from cart.
- Result: Pass

### TC-05: Clear Cart
- Verified entire cart clears successfully.
- Result: Pass

### TC-06: Totals Calculation
- Verified:
- Subtotal equals sum of line totals
- Tax equals 5% of subtotal
- Shipping equals 10% of subtotal
- Grand total equals subtotal + tax + shipping
- Result: Pass

### TC-07: Checkout
- Verified cart clears on checkout.
- Verified confirmation popup appears once.
- Verified user is returned to catalog.
- Result: Pass

---

## Development Phases

- Week 1: Project planning
- Week 2: Database creation and framework setup
- Week 3: Cart functionality implementation
- Week 4: MVC refactoring
- Week 5: Totals calculation, checkout, and final testing

---

## Final Release

This final tested version is tagged in GitHub as:

**phase5**

---

## Author

David Southwell  
SDC310L – Server-Side Scripting
