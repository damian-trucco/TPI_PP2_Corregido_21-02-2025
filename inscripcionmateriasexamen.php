<?php
require_once 'conexion.php';
$conn = obtenerConexion();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $documento = $_POST['documento'] ?? '';
    $email = $_POST['email'] ?? '';

    // Obtener materias inscritas del alumno
    $stmt = $conn->prepare("SELECT m.nombre AS materia, m.carrera, i.fecha, i.horario 
                            FROM inscripcion_examen i 
                            JOIN materias m ON i.id_materia = m.id 
                            JOIN pre_inscripcion p ON i.id_alumno = p.ID_pre_inscripcion 
                            WHERE p.documento = ?");
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $result = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción a Materias</title>
</head>
<body>
    <h1>Inscripción a Materias</h1>
    <form action="registromateriasexamen.php" method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required><br>

        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= htmlspecialchars($apellido) ?>" required><br>

        <label>Documento:</label>
        <input type="text" name="documento" value="<?= htmlspecialchars($documento) ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br>

        <h2>Materias Inscritas</h2>
        <table border="1">
            <tr>
                <th>Materia</th>
                <th>Carrera</th>
                <th>Fecha</th>
                <th>Horario</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['materia']) ?></td>
                    <td><?= htmlspecialchars($row['carrera']) ?></td>
                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                    <td><?= htmlspecialchars($row['horario']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <br>
        <button type="submit">Enviar</button>
        <button type="button" onclick="window.location.href='inscripcionamesadeexamenes.php'">Deshacer</button>
        <button type="button" onclick="window.print();">Imprimir comprobante</button>
    </form>
</body>
</html>
