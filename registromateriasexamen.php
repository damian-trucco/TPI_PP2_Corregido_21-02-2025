<?php
require_once 'conexion.php';
$conn = obtenerConexion();

// Obtener inscripciones de alumnos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_alumno = $_POST['id_alumno'];
    $id_materia = $_POST['id_materia'];
    $fecha = $_POST['fecha'];
    $horario = $_POST['horario'];

    $stmt = $conn->prepare("INSERT INTO inscripcion_examen (id_alumno, id_materia, fecha, horario) 
                            VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $id_alumno, $id_materia, $fecha, $horario);
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Inscripciones a Exámenes</title>
</head>
<body>
    <h1>Registro de Inscripciones a Exámenes</h1>
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Documento</th>
            <th>Domicilio</th>
            <th>Email</th>
            <th>Carrera</th>
            <th>Materia</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nombre']) ?></td>
                <td><?= htmlspecialchars($row['apellido']) ?></td>
                <td><?= htmlspecialchars($row['documento']) ?></td>
                <td><?= htmlspecialchars($row['domicilio']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['carrera']) ?></td>
                <td><?= htmlspecialchars($row['materia']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
