<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load core dependencies
require_once 'core/Router.php';
require_once 'controllers/EventController.php';
require_once 'controllers/AttendeeController.php';
require_once 'controllers/BookingController.php';
require_once 'database/Database.php';
require_once 'models/Event.php';
require_once 'models/Attendee.php';
require_once 'models/Booking.php';
require_once 'validation/Validator.php';

// Create Router instance
$router = new Router('/event-booking-api');

// Register routes
$router->add('GET', '/events', [EventController::class, 'index']);
$router->add('POST', '/events', [EventController::class, 'store']);
$router->add('PUT', '/events/{id}', [EventController::class, 'update']);
$router->add('DELETE', '/events/{id}', [EventController::class, 'destroy']);

$router->add('POST', '/attendees', [AttendeeController::class, 'store']);
$router->add('PUT', '/attendees/{id}', [AttendeeController::class, 'update']);
$router->add('DELETE', '/attendees/{id}', [AttendeeController::class, 'destroy']);

$router->add('POST', '/bookings', [BookingController::class, 'book']);

// Dispatch the current request
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
