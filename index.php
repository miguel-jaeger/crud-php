<?php
// Incluye los archivos del Modelo
require_once './modelo/Conexion.php';
require_once './modelo/Estudiante.php';

// Conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
$estudiante = new Estudiante($db);

// Determina la acción a realizar
$action = isset($_GET['action']) ? $_GET['action'] : '';
$post_action = isset($_POST['action']) ? $_POST['action'] : '';

// Lógica del controlador

if($post_action == 'crear'){
    // Si la acción es 'crear' (viene del formulario POST)
    $estudiante->nombre = $_POST['nombre'];
    $estudiante->apellido = $_POST['apellido'];
    $estudiante->correo = $_POST['correo'];

    // Llama al método del Modelo para guardar los datos
    if($estudiante->crear()){
        // Redirige a la lista de estudiantes si todo sale bien
        header("Location: index.php?action=listar&status=success");
        exit();
    } else {
        echo "Error al crear estudiante.";
    }
} else if ($action == 'listar') {
    // Si la acción es 'listar' (viene de una petición GET)
    // Llama al método del Modelo para obtener los datos
    $estudiantes = $estudiante->leer();
    // Carga la Vista para mostrar la lista
    require_once './vista/Listar.php';
}
 else if ($action == 'eliminar') {
   
    // Si la acción es 'listar' (viene de una petición GET)
    // Llama al método del Modelo para obtener los datos
    $estudiantes = $estudiante->eliminar($_GET['id']);
    
    // Carga la Vista para mostrar la lista
    header('Location: ./index.php');

} else {
    // Si no se especifica ninguna acción, muestra el formulario por defecto
    require_once './vista/Registro.php';
}
?>