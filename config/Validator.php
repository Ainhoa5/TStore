<?php 
// In /config/Validator.php
class Validator {
    private $errors = [];

    public function validate($fields, $rules) {
        foreach ($fields as $field => $value) {
            if (isset($rules[$field])) {
                foreach ($rules[$field] as $rule) {
                    $this->$rule($value, $field);
                }
            }
        }
        return $this->errors;
    }

    private function isEmpty($value, $field) {
        if (empty($value)) {
            $this->errors[$field][] = 'Field is empty';
        }
    }

    private function isValidEmail($email, $field) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Invalid email format';
        }
    }

    // Add more validation methods as needed...
}

?>