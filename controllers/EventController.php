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
        $affected = Event::update($id, $data);
         if ($affected === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Event ID not found']);
            return;
        }
        echo json_encode(['message' => 'Event updated successfully']);
    }

    public static function destroy($params) {
          $affected = Event::delete($params['id']);
    if ($affected === 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Event ID not found']);
        return;
    }
        echo json_encode(['message' => 'Event deleted']);
    }
}

?>