<?php
session_start();
require_once './data_base/db_urquiza.php';

// Verificar si hay datos en la sesión para registrar
if (isset($_SESSION['registro']) && !empty($_SESSION['registro'])) {
    $registro = $_SESSION['registro'];
    $nombre = $registro['nombre'];
    $apellido = $registro['apellido'];
    $documento = $registro['documento'];
    $direccion = $registro['direccion'];
    $email = $registro['email'];
    $carrera_id = $registro['carrera_id'];
    $materias = $registro['materias'];
    $tipo_estudiante = $registro['tipo_estudiante'] ?? 'No especificado';

    // Obtener el nombre de la carrera
    $stmt = $conexion->prepare("SELECT nombre FROM carreras WHERE id = ?");
    $stmt->execute([$carrera_id]);
    $carrera_nombre = $stmt->fetchColumn();

    try {
        $conexion->beginTransaction();

        // Verificar si el alumno ya está registrado
        $stmt = $conexion->prepare("SELECT ID_Alumno FROM alumnos WHERE documento = ?");
        $stmt->execute([$documento]);
        $ID_Alumno = $stmt->fetchColumn();

        if (!$ID_Alumno) {
            // Insertar nuevo alumno
            $stmt = $conexion->prepare("INSERT INTO alumnos (nombre, apellido, documento, domicilio, email, carrera_id) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $apellido, $documento, $direccion, $email, $carrera_id]);
            $ID_Alumno = $conexion->lastInsertId();
        }

        // Insertar inscripciones en materias evitando duplicados
        $stmt = $conexion->prepare("INSERT IGNORE INTO inscripciones_materias (ID_Alumno, ID_materia) VALUES (?, ?)");
        foreach ($materias as $ID_materia) {
            $stmt->execute([$ID_Alumno, $ID_materia]);
        }

        $conexion->commit();
        unset($_SESSION['registro']); // Limpiar sesión después del registro
    } catch (PDOException $e) {
        $conexion->rollBack();
        die("Error en la inscripción: " . $e->getMessage());
    }
}

// Contador de alumnos inscriptos
$stmt = $conexion->query("SELECT COUNT(*) FROM alumnos");
$total_alumnos = $stmt->fetchColumn();

// Obtener listado de alumnos con sus materias en una sola fila
$stmt = $conexion->query("
    SELECT 
        a.nombre, 
        a.apellido, 
        a.documento, 
        c.nombre AS carrera, 
        GROUP_CONCAT(DISTINCT m.nombre ORDER BY m.nombre SEPARATOR ', ') AS materias
    FROM alumnos a
    JOIN carreras c ON a.carrera_id = c.id
    JOIN inscripciones_materias im ON a.ID_Alumno = im.ID_Alumno
    JOIN materias m ON im.ID_materia = m.id
    GROUP BY a.ID_Alumno
    ORDER BY a.apellido, a.nombre
");
$inscripciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de inscripción a las materias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
        }
        .contador {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de inscripción a las materias</h1>

        <div class="contador">
            Total de alumnos inscriptos: <?php echo $total_alumnos; ?>
        </div>

        <h2>Listado de alumnos inscriptos</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Documento</th>
                <th>Carrera</th>
                <th>Materias</th>
            </tr>
            <?php foreach ($inscripciones as $inscripcion): ?>
                <tr>
                    <td><?php echo htmlspecialchars($inscripcion['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($inscripcion['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($inscripcion['documento']); ?></td>
                    <td><?php echo htmlspecialchars($inscripcion['carrera']); ?></td>
                    <td><?php echo htmlspecialchars($inscripcion['materias']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
