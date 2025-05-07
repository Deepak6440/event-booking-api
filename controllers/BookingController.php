<?php
class BookingController {
    public static function book() {
        $data = json_decode(file_get_contents("php://input"), true);
        $eventId = $data['event_id'];
        $attendeeId = $data['attendee_id'];

        if (Booking::isAlreadyBooked($eventId, $attendeeId)) {
            http_response_code(409);
            echo json_encode(['error' => 'Attendee already booked for this event']);
            return;
        }

        $event = Event::find($eventId);
        if (!$event) {
            http_response_code(404);
            echo json_encode(['error' => 'Event not found']);
            return;
        }

        $currentBookings = Booking::getBookingCount($eventId);
        if ($currentBookings >= $event['capacity']) {
            http_response_code(400);
            echo json_encode(['error' => 'Event is fully booked']);
            return;
        }

        Booking::create($eventId, $attendeeId);
        echo json_encode(['message' => 'Booking successful']);
    }
}


?>