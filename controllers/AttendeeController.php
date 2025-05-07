<?php
class AttendeeController {
    public static function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        $errors = Validator::validateAttendee($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        Attendee::create($data);
        echo json_encode(['message' => 'Attendee registered successfully']);
    }

    public static function update($params) {
        $id = $params['id'];
        $data = json_decode(file_get_contents("php://input"), true);
        $errors = Validator::validateAttendee($data);
        if ($errors) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }
        $affected =  Attendee::update($id, $data);
         if ($affected === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Attendee ID not found']);
            return;
        }
        echo json_encode(['message' => 'Attendee updated successfully']);
    }

    public static function destroy($params) {
         $affected = Attendee::delete($params['id']);
         if ($affected === 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Attendee ID not found']);
        return;
    }
        echo json_encode(['message' => 'Attendee deleted']);
    }
}

?>