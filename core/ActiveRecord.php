<?php
namespace Core;

// In /core/ActiveRecord.php

/**
 * Clase ActiveRecord para proporcionar funcionalidades básicas de ORM.
 *
 * Esta clase implementa operaciones CRUD (Crear, Leer, Actualizar, Borrar)
 * para interactuar con la base de datos de manera más abstracta y segura.
 */
class ActiveRecord
{
    /**
     * @var \PDO Instancia de la conexión a la base de datos.
     */
    protected $db;

    /**
     * @var string Nombre de la tabla en la base de datos a la cual esta clase hace referencia.
     */
    protected $table;

    /**
     * @var string Nombre de la clave primaria de la tabla en la base de datos a la cual esta clase hace referencia.
     */
    protected $primaryKey;

    /**
     * Constructor de la clase.
     *
     * @param \PDO $db Instancia de la conexión a la base de datos.
     * @param string $table Nombre de la tabla en la base de datos.
     * @param string $id Nombre de la clave primaria de la tabla en la base de datos.
     */
    public function __construct($db, $table, $primaryKey)
    {
        $this->db = $db;
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }

    /**
     * Encuentra y devuelve todos los registros de la tabla.
     *
     * @return array|false Los registros encontrados o false en caso de error.
     */
    public function findAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    /**
     * Encuentra y devuelve un registro específico por su ID.
     *
     * @param mixed $id Identificador único del registro a buscar.
     * @return array|false Resultado de la consulta o false en caso de error.
     */
    public function findById($id)
    {
        try {
            // Usa la propiedad $this->primaryKey en la cláusula WHERE
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }
    }

    /**
     * Crea un nuevo registro en la tabla con los datos proporcionados.
     *
     * @param array $data Los datos del nuevo registro.
     * @return bool True si el registro es creado exitosamente, false en caso contrario.
     */
    public function create($data)
    {
        try {
            $keys = array_keys($data);
            $fields = implode(', ', $keys);
            $placeholders = ':' . implode(', :', $keys);

            $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";
            $stmt = $this->db->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            return $stmt->execute();
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }

    }

    /**
     * Actualiza un registro existente en la tabla con los datos proporcionados.
     *
     * @param array $data Datos para actualizar en el registro.
     * @param mixed $id Identificador único del registro a actualizar.
     * @return bool True en éxito, false en caso contrario.
     */
    public function update($data, $id)
    {
        try {
            $updates = [];
            foreach ($data as $key => $value) {
                $updates[] = "{$key} = :{$key}";
            }
            $updatesString = implode(', ', $updates);

            $sql = "UPDATE {$this->table} SET {$updatesString} WHERE {$this->primaryKey} = :id";
            $stmt = $this->db->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }
    }

    /**
     * Elimina un registro específico de la tabla por su ID.
     *
     * @param mixed $id Identificador único del registro a eliminar.
     * @return bool True en éxito, false en caso contrario.
     */
    public function delete($id)
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (\PDOException $e) {
            \Config\Functions::logError($e->getMessage());
            return false;
        }
    }
}
