<?php
// Incluye los archivos del Modelo
require_once './modelo/Conexion.php';
require_once './modelo/Estudiante.php';

// Conexión a la base de datos
$database = new Database();
$db = $database->getConnection();
$estudiante = new Estudiante($db);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Estudiante</title>
</head>
<body>
    <?php
    $action = isset($_GET["action"]) ? $_GET["action"] :"";
    if($action == "editar") {
        $datos= $estudiante->obtenerPorId($_GET["id"]);
      /*  echo "<pre>";
        print_r($datos);die;*/
    }
    ?>
    <h1>Registrar Nuevo Estudiante</h1>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required value="<?php echo isset($datos['nombre']) ? $datos['nombre'] :"";?>"><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required value="<?php echo isset($datos['apellido']) ? $datos['apellido'] :"";?>"><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required value="<?php echo isset($datos['correo']) ? $datos['correo'] :"";?>"><br><br>
        <input type="hidden" name="action" value="<?php echo $action ?>">
        <input type="hidden" name="id_estudiante" value="<?php echo isset($datos['id_estudiante']) ? $datos['id_estudiante'] :"";?>">
        <button type="submit">Guardar</button>
    </form>
    <hr>
    <a href="index.php?action=listar">Ver lista de estudiantes</a>
</body>
</html>