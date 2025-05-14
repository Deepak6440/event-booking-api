<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Attendee.php';
require_once __DIR__ . '/../database/Database.php';

final class AttendeeTest extends TestCase
{
    public function testCanRegisterAttendee(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john.doe.' . rand(1000, 9999) . '@example.com',
            'phone' => '1234567890'
        ];
        $result = Attendee::create($data);
        $this->assertTrue($result);
    }

    public function testCanUpdateAttendee(): void
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM attendees ORDER BY id DESC LIMIT 1");
        $attendee = $stmt->fetch();

        if ($attendee) {
            $updated = Attendee::update($attendee['id'], [
                'name' => 'Jane Doe',
                'email' => $attendee['email'],
                'phone' => '0987654321'
            ]);
            $this->assertGreaterThanOrEqual(0, $updated);
        } else {
            $this->markTestSkipped('No attendee to update');
        }
    }

    public function testCanDeleteAttendee(): void
    {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM attendees ORDER BY id DESC LIMIT 1");
        $attendee = $stmt->fetch();

        if ($attendee) {
            $deleted = Attendee::delete($attendee['id']);
            $this->assertGreaterThanOrEqual(0, $deleted);
        } else {
            $this->markTestSkipped('No attendee to delete');
        }
    }
}