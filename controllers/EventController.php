<?php
class EventController {
    public static function index() {
        echo json_encode(Event::all());
    }

    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        $errors = Validator::validateEvent($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        Event::create($data);
        echo json_encode(['message' => 'Event created successfully']);
    }

    public static function update($params) {
        $id = $params['id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $errors = Validator::validateEvent($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        Event::update($id, $data);
        echo json_encode(['message' => 'Event updated successfully']);
    }

    public static function destroy($params) {
        Event::delete($params['id']);
        echo json_encode(['message' => 'Event deleted']);
    }
}

?>