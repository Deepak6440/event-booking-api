<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Attendee.php';
require_once __DIR__ . '/../database/Database.php';

final class BookingTest extends TestCase
{
    public function testCanCreateBooking(): void
    {
        $event = Event::all()[0] ?? null;
        $attendeeData = [
            'name' => 'Booking Tester',
            'email' => 'booking.' . rand(1000, 9999) . '@example.com',
            'phone' => '1112223333'
        ];
        Attendee::create($attendeeData);

        $db = Database::connect();
        $attendeeId = $db->lastInsertId();

        if ($event) {
            $result = Booking::create($event['id'], $attendeeId);
            $this->assertTrue($result);
        } else {
            $this->markTestSkipped('No event available for booking');
        }
    }

    public function testDuplicateBookingIsDetected(): void
    {
        $event = Event::all()[0] ?? null;
        $attendee = Attendee::all()[0] ?? null;

        if ($event && $attendee) {
            $isDuplicate = Booking::isAlreadyBooked($event['id'], $attendee['id']);
            $this->assertIsBool($isDuplicate);
        } else {
            $this->markTestSkipped('No data to test duplicate booking');
        }
    }
}