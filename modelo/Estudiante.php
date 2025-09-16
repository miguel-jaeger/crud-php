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

    public function actualizar() {
    // La sentencia UPDATE utiliza WHERE para identificar el registro por su id
    $query = "UPDATE " . $this->table_name . "
              SET nombre=:nombre, apellido=:apellido, correo=:correo
              WHERE id_estudiante = :id_estudiante";
    
    $stmt = $this->conn->prepare($query);

    // Limpia y vincula los datos, igual que en el método crear()
    $this->nombre = htmlspecialchars(strip_tags($this->nombre));
    $this->apellido = htmlspecialchars(strip_tags($this->apellido));
    $this->correo = htmlspecialchars(strip_tags($this->correo));
    $this->id_estudiante = htmlspecialchars(strip_tags($this->id_estudiante));

    $stmt->bindParam(":nombre", $this->nombre);
    $stmt->bindParam(":apellido", $this->apellido);
    $stmt->bindParam(":correo", $this->correo);
    $stmt->bindParam(":id_estudiante", $this->id_estudiante); // Vincula el id para el WHERE


    if($stmt->execute()){
        return true;
    }
    return false;
}

public function obtenerPorId($id) {
    // Consulta para seleccionar un solo registro por su ID
    $query = "SELECT * FROM " . $this->table_name . " WHERE id_estudiante = ? LIMIT 0,1";

    // Prepara la consulta
    $stmt = $this->conn->prepare($query);

    // Vincula el ID
    $stmt->bindParam(1, $id);

    // Ejecuta la consulta
    $stmt->execute();

    // Obtiene el registro como un arreglo asociativo
    //$row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si se encontró el registro, asigna sus valores a las propiedades del objeto
    return $stmt->fetch(PDO::FETCH_ASSOC); // Indica que no se encontró el estudiante
}

    // Método para leer todos los estudiantes
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id_estudiante DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //Eliminar estudiante
    public function eliminar($id_estudiante) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_estudiante=$id_estudiante";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>