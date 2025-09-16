<!DOCTYPE html>
<html>
<head>
    <title>Lista de Estudiantes</title>
</head>
<body>
    <h1>Lista de Estudiantes</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $estudiantes->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td><?php echo $row['id_estudiante']; ?></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['apellido']; ?></td>
                <td><?php echo $row['correo']; ?></td>
                <td><a href="index.php?action=eliminar&id=<?php echo $row['id_estudiante']; ?>">Eliminar</a></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="index.php">Volver al formulario</a>
</body>
</html>