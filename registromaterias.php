<?php
session_start();
require_once './data_base/db_urquiza.php';

if (!isset($_SESSION['registro'])) {
    die("No hay datos para registrar.");
}

$registro = $_SESSION['registro'];
$nombre = $registro['nombre'];
$apellido = $registro['apellido'];
$documento = $registro['documento'];
$direccion = $registro['direccion'];
$email = $registro['email'];
$carrera_id = $registro['carrera_id'];
$materias = $registro['materias'];

try {
    $conexion->beginTransaction();

    // Verificar si el alumno ya existe
    $stmt = $conexion->prepare("SELECT id FROM alumnos WHERE documento = ?");
    $stmt->execute([$documento]);
    $alumno_id = $stmt->fetchColumn();

    if (!$alumno_id) {
        // Insertar nuevo alumno
        $stmt = $conexion->prepare("INSERT INTO alumnos (nombre, apellido, documento, domicilio, email, carrera_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $documento, $direccion, $email, $carrera_id]);
        $alumno_id = $conexion->lastInsertId();
    }

    // Insertar inscripciones en materias
    $stmt = $conexion->prepare("INSERT INTO inscripciones_materias (alumno_id, materia_id) VALUES (?, ?)");
    foreach ($materias as $materia_id) {
        $stmt->execute([$alumno_id, $materia_id]);
    }

    $conexion->commit();
    echo "Registro exitoso.";

    // Limpiar sesión
    unset($_SESSION['registro']);

} catch (PDOException $e) {
    $conexion->rollBack();
    die("Error en la inscripción: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Inscripciones</title>
</head>
<body>
    <h1>Inscripción realizada</h1>
    <p>El alumno <b><?php echo htmlspecialchars($nombre . " " . $apellido); ?></b> ha sido inscrito en las siguientes materias:</p>
    <ul>
        <?php
        foreach ($materias as $materia_id) {
            $stmt = $conexion->prepare("SELECT nombre FROM materias WHERE id = ?");
            $stmt->execute([$materia_id]);
            $materia = $stmt->fetchColumn();
            echo "<li>" . htmlspecialchars($materia) . "</li>";
        }
        ?>
    </ul>
</body>
</html>
