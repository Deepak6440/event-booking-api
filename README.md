# 🎟️ Event Booking API (PHP REST)

A lightweight PHP RESTful API to manage Events, Attendees, and Bookings — designed using OOP principles, PDO for DB interaction, and a custom router.

---

## 🚀 Tech Stack

- **Language**: PHP 7.4+
- **Database**: MySQL
- **Web Server**: Apache (Hostinger/XAMPP/Laragon)
- **Architecture**: RESTful
- **Tools**: Postman, PDO, OOP

---

## 📦 Folder Structure

```
event-booking-api/
├── index.php
├── .htaccess
├── core/
│   └── Router.php
├── controllers/
│   ├── EventController.php
│   ├── AttendeeController.php
│   └── BookingController.php
├── models/
│   ├── Event.php
│   ├── Attendee.php
│   └── Booking.php
├── validation/
│   └── Validator.php
├── database/
│   └── Database.php
```

---

## ⚙️ Setup Instructions

1. **Clone or upload** project to your PHP server (`public_html/event-booking-api` on Hostinger).
2. **Import Database** using `schema.sql` provided.
3. **Update DB credentials** inside `Database.php`.
4. **Ensure mod_rewrite is enabled** and `.htaccess` is configured.
5. Use Postman to interact with endpoints like:
    - `GET /events`
    - `POST /events`
    - `POST /attendees`
    - `POST /bookings`

---

## ✅ API Coverage (Tests You Should Write)

| Functionality | Test Case | Expected |
|---------------|-----------|----------|
| Create Event | POST /events with valid data | 201 Created |
| Overbooking | POST /bookings when full | 400 error |
| Duplicate Booking | Same attendee + event | 409 conflict |
| Delete Attendee | DELETE /attendees/{id} | 200 or 404 |
| Update Nonexistent Event | PUT /events/999 | 404 |
| Invalid Event Payload | POST /events with empty name | 422 with validation error |

> Use PHPUnit or Postman/Newman for automated testing.

---

## 🧭 Architecture Diagram

```
[Client / Postman]
       ↓
  index.php (Front Controller)
       ↓
    Router.php
       ↓
 ┌────────────┬──────────────┬─────────────────────────
 │EventController│AttendeeController│BookingController │
 └────────────┴──────────────┴─────────────────────────
       ↓
    Models (Event, Attendee, Booking)
       ↓
   Database (MySQL via PDO)
```

---

## 🔐 Authentication

Not implemented, but can be added via middleware (JWT or token headers) for admin routes.

---

## 📬 Contact

For help or feedback, raise a GitHub issue or email the maintainer.
---

## 🧪 Running Automated Tests (PHPUnit)

1. Ensure you have **PHPUnit installed**:
    ```bash
    composer require --dev phpunit/phpunit
    ```

2. Place the test files in a `tests/` directory:
    ```
    /tests
      ├── EventTest.php
      ├── AttendeeTest.php
      └── BookingTest.php
    ```

3. Run individual tests:
    ```bash
    ./vendor/bin/phpunit tests/EventTest.php
    ./vendor/bin/phpunit tests/AttendeeTest.php
    ./vendor/bin/phpunit tests/BookingTest.php
    ```

4. Or run all at once:
    ```bash
    ./vendor/bin/phpunit tests
    ```

Each test file covers create, read, update, and delete (CRUD) operations, including validations like overbooking or duplicates.
