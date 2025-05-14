<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../database/Database.php';

final class EventTest extends TestCase
{
    public function testCanCreateEvent(): void
    {
        $data = [
            'name' => 'Test Event',
            'description' => 'Test Description',
            'date' => '2025-12-25 10:00:00',
            'location' => 'Test City',
            'capacity' => 50
        ];

        $result = Event::create($data);
        $this->assertTrue($result);
    }

    public function testCanFetchEvents(): void
    {
        $events = Event::all();
        $this->assertIsArray($events);
    }

    public function testCanFindEventById(): void
    {
        $existingEvents = Event::all();
        if (!empty($existingEvents)) {
            $event = Event::find($existingEvents[0]['id']);
            $this->assertNotEmpty($event);
            $this->assertArrayHasKey('name', $event);
        } else {
            $this->markTestSkipped('No events to fetch');
        }
    }

    public function testUpdateEvent(): void
    {
        $events = Event::all();
        if (!empty($events)) {
            $first = $events[0];
            $updated = Event::update($first['id'], [
                'name' => 'Updated Event',
                'description' => 'Updated',
                'date' => $first['date'],
                'location' => $first['location'],
                'capacity' => $first['capacity']
            ]);
            $this->assertGreaterThanOrEqual(0, $updated);
        } else {
            $this->markTestSkipped('No event to update');
        }
    }

    public function testDeleteEvent(): void
    {
        $events = Event::all();
        if (!empty($events)) {
            $id = $events[count($events) - 1]['id'];
            $deleted = Event::delete($id);
            $this->assertGreaterThanOrEqual(0, $deleted);
        } else {
            $this->markTestSkipped('No event to delete');
        }
    }
}