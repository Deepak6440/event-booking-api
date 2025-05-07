<?php
class Event {
    public static function all() {
        $db = Database::connect();
        return $db->query("SELECT * FROM events")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO events (name, description, date, location, capacity) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'], $data['description'], $data['date'], $data['location'], $data['capacity']
        ]);
    }

    public static function update($id, $data) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE events SET name=?, description=?, date=?, location=?, capacity=? WHERE id=?");
        return $stmt->execute([
            $data['name'], $data['description'], $data['date'], $data['location'], $data['capacity'], $id
        ]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}


?>