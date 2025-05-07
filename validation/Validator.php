<?php
class Validator {
    public static function validateEvent($data) {
        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Name is required';
        if (empty($data['date'])) $errors['date'] = 'Date is required';
        if (empty($data['capacity']) || !is_numeric($data['capacity'])) $errors['capacity'] = 'Capacity must be a number';
        return $errors;
    }

    public static function validateAttendee($data) {
        $errors = [];
        if (empty($data['name'])) $errors['name'] = 'Name is required';
        if (empty($data['email'])) $errors['email'] = 'Email is required';
        return $errors;
    }
}


?>