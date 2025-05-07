<?php 
class Attendee {
    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO attendees (name, email, phone) VALUES (?, ?, ?)");
        return $stmt->execute([$data['name'], $data['email'], $data['phone']]);
    }

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE attendees SET name=?, email=?, phone=? WHERE id=?");
        return $stmt->execute([$data['name'], $data['email'], $data['phone'], $id]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM attendees WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

?>