<?php
namespace Config;

// In /config/Validator.php

/**
 * Clase Validator para realizar validaciones de campos de formulario.
 *
 * Proporciona métodos para validar diferentes tipos de datos de entrada, como emails, contraseñas,
 * números, strings, y valores decimales, acumulando errores encontrados durante la validación.
 */
class Validator
{

    /**
     * @var array Almacena los errores de validación encontrados.
     */
    private $errors = [];

    /**
     * Valida campos de formulario basados en reglas específicas.
     *
     * @param array $fields Campos a validar con sus valores.
     * @param array $rules Reglas de validación a aplicar a los campos.
     * @return array Retorna un array de errores de validación.
     */
    public function validate($fields, $rules)
    {
        foreach ($fields as $field => $value) {
            if (isset($rules[$field])) {
                foreach ($rules[$field] as $rule) {
                    $this->$rule($value, $field);
                }
            }
        }
        return $this->errors;
    }

    /**
     * Verifica si un campo está vacío.
     *
     * @param mixed $value Valor del campo.
     * @param string $field Nombre del campo.
     */
    private function isEmpty($value, $field)
    {
        if (empty($value)) {
            $this->errors[$field][] = 'Field is empty';
        }
    }

    /**
     * Verifica si el valor es un email válido.
     *
     * @param string $email Email a validar.
     * @param string $field Nombre del campo.
     */
    private function isValidEmail($email, $field)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Invalid email format';
        }
    }

    /**
     * Verifica si una contraseña es segura.
     *
     * @param string $password Contraseña a validar.
     * @param string $field Nombre del campo.
     */
    private function isSecurePassword($password, $field)
    {
        if (strlen($password) < 8) {
            $this->errors[$field][] = 'Password must be at least 8 characters long';
        }
        // Add more password checks (uppercase, number, symbol, etc.) as needed
    }

    /**
     * Verifica si un valor es numérico.
     *
     * @param mixed $value Valor a validar.
     * @param string $field Nombre del campo.
     */
    private function isNumeric($value, $field)
    {
        if (!is_numeric($value)) {
            $this->errors[$field][] = 'Field must be a number';
        }
    }

    /**
     * Verifica si un string es válido (solo letras y espacios).
     *
     * @param string $value Valor a validar.
     * @param string $field Nombre del campo.
     */
    private function isValidString($value, $field)
    {
        if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
            $this->errors[$field][] = 'Field must contain only letters and spaces';
        }
    }

    /**
     * Verifica si un valor es un número decimal válido.
     *
     * @param string $value Valor a validar.
     * @param string $field Nombre del campo.
     */
    private function isValidDecimal($value, $field)
    {
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $value)) {
            $this->errors[$field][] = 'Field must be a valid decimal number';
        }
    }

    // Se pueden añadir más métodos de validación según sea necesario...
}