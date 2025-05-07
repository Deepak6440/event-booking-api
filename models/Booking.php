<?php
class Booking {
    public static function create($eventId, $attendeeId) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO bookings (event_id, attendee_id) VALUES (?, ?)");
        return $stmt->execute([$eventId, $attendeeId]);
    }

    public static function isAlreadyBooked($eventId, $attendeeId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT COUNT(*) FROM bookings WHERE event_id = ? AND attendee_id = ?");
        $stmt->execute([$eventId, $attendeeId]);
        return $stmt->fetchColumn() > 0;
    }

    public static function getBookingCount($eventId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT COUNT(*) FROM bookings WHERE event_id = ?");
        $stmt->execute([$eventId]);
        return $stmt->fetchColumn();
    }
}

?>