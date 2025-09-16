<!DOCTYPE html>
<html>
<head>
    <title>Registrar Estudiante</title>
</head>
<body>
    <h1>Registrar Nuevo Estudiante</h1>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br>
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        <input type="hidden" name="action" value="crear">
        <button type="submit">Guardar</button>
    </form>
    <hr>
    <a href="index.php?action=listar">Ver lista de estudiantes</a>
</body>
</html>