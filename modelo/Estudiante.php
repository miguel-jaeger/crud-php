<?php
require_once 'Conexion.php';

class Estudiante {
    private $conn;
    private $table_name = "estudiantes";

    // camps de la tabla estudiantes
    public $id_estudiante;
    public $nombre;
    public $apellido;
    public $correo;

    public function __construct($db){
        $this->conn = $db;
    }

    // Método para crear un nuevo estudiante
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, apellido=:apellido, correo=:correo";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->apellido = htmlspecialchars(strip_tags($this->apellido));
        $this->correo = htmlspecialchars(strip_tags($this->correo));

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":apellido", $this->apellido);
        $stmt->bindParam(":correo", $this->correo);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // Método para leer todos los estudiantes
    public function leer() {
        $query = "SELECT id_estudiante, nombre, apellido, correo FROM " . $this->table_name . " ORDER BY id_estudiante DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>