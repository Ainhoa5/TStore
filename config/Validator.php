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

    private function isSecurePassword($password, $field) {
        if (strlen($password) < 8) {
            $this->errors[$field][] = 'Password must be at least 8 characters long';
        }
        // Add more password checks (uppercase, number, symbol, etc.) as needed
    }

    private function isNumeric($value, $field) {
        if (!is_numeric($value)) {
            $this->errors[$field][] = 'Field must be a number';
        }
    }

    private function isValidString($value, $field) {
        if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
            $this->errors[$field][] = 'Field must contain only letters and spaces';
        }
    }

    private function isValidDecimal($value, $field) {
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $value)) {
            $this->errors[$field][] = 'Field must be a valid decimal number';
        }
    }

    // Add more validation methods as needed...
}

?>