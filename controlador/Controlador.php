<?php
require_once './modelo/Conexion.php';
require_once './modelo/Estudiante.php';

$database = new Database();
$db = $database->getConnection();
$estudiante = new Estudiante($db);

$action = isset($_GET['action']) ? $_GET['action'] : '';
$post_action = isset($_POST['action']) ? $_POST['action'] : '';

if($post_action == 'crear'){
    $estudiante->nombre = $_POST['nombre'];
    $estudiante->apellido = $_POST['apellido'];
    $estudiante->correo = $_POST['correo'];

    if($estudiante->crear()){
        header("Location: index.php?action=listar&status=success");
        exit();
    } else {
        echo "Error al crear estudiante.";
    }
} else if ($action == 'listar') {
    $estudiantes = $estudiante->leer();
    require_once './vista/Listar.php';
} else if( $action == 'eliminar') { 
    $estudiante->eliminar($_GET['id']);  
    require_once './vista/Listar.php';  
}else{
    // Si no se especifica ninguna acción, muestra el formulario
    require_once './vista/Registro.php';
}
?>