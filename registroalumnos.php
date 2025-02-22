<?php
require 'conexion.php';

// Mapeo de códigos de carrera a nombres completos
$carreras = [
    'af' => "Técnico Superior en Análisis Funcional de Sistemas Informáticos",
    'ds' => "Técnico Superior en Desarrollo de Software",
    'iti' => "Técnico Superior en Infraestructura de Tecnología de la Información"
];

// Obtener los máximos de inscripción desde la base de datos
$maximos_inscripciones = [];
foreach ($carreras as $codigo => $nombre) {
    $consulta = "SELECT valor FROM configuracion WHERE clave = 'max_inscripciones_$codigo'";
    $resultado = $conn->query($consulta);
    $fila = $resultado->fetch_assoc();
    $maximos_inscripciones[$codigo] = $fila ? (int)$fila['valor'] : 100; // Valor por defecto 100 si no hay configuración
}

// Procesar el formulario de actualización de cupos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($carreras as $codigo => $nombre) {
        if (isset($_POST["max_inscripciones_$codigo"])) {
            $nuevo_cupo = (int)$_POST["max_inscripciones_$codigo"];
            // Actualizar el valor de max_inscripciones en la base de datos
            $consulta_actualizacion = "UPDATE configuracion SET valor = $nuevo_cupo WHERE clave = 'max_inscripciones_$codigo'";
            $conn->query($consulta_actualizacion);
            $maximos_inscripciones[$codigo] = $nuevo_cupo; // Actualizar el array local
        }
    }
}

// Obtener la cantidad de inscriptos en cada carrera
$inscriptos = [];
foreach (array_keys($carreras) as $codigo) {
    $consulta_cantidad = "SELECT COUNT(*) as total FROM pre_inscripcion WHERE Carrera = '$codigo'";
    $resultado_cantidad = $conn->query($consulta_cantidad);
    $fila_cantidad = $resultado_cantidad->fetch_assoc();
    $inscriptos[$codigo] = $fila_cantidad['total'];
}

// Función para obtener las iniciales en mayúsculas
function obtener_iniciales($carrera) {
    switch ($carrera) {
        case 'af':
            return 'AF';
        case 'ds':
            return 'DS';
        case 'iti':
            return 'ITI';
        default:
            return 'No especificado';
    }
}

// Obtener la lista de alumnos registrados
$consulta = "SELECT ID_pre_inscripcion, Nombre, Apellido, Documento, Domicilio, Email, Carrera FROM pre_inscripcion ORDER BY ID_pre_inscripcion DESC";
$resultado = $conn->query($consulta);

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./css/style.css">
<title>Control de Cupos</title>
<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        background-color: #f5f5f5;
    }
    .container {
        display: flex;
        width: 80%;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .box {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .left-box {
        flex: 1;
        margin-right: 20px;
    }
    .right-box {
        flex: 1;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>
    <h1>Registro de Alumnos</h1>
    <div class="container">
        <div class="box left-box">
            <h2>Inscripciones</h2>
            <?php foreach ($carreras as $codigo => $nombre): ?>
                <p><strong><?php echo $nombre; ?></strong> - Registrados: <strong><?php echo $inscriptos[$codigo] ?? 0; ?></strong> / Máximo: <strong><?php echo $maximos_inscripciones[$codigo] ?? 'No definido'; ?></strong></p>
                <?php if ($inscriptos[$codigo] >= $maximos_inscripciones[$codigo]): ?>
                    <p style="color: red; font-weight: bold;">¡Cupos completos para esta carrera!</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="box right-box">
            <h2>Establecer máximos de inscripción</h2>
            <form method="post">
                <?php foreach ($carreras as $codigo => $nombre): ?>
                    <label for="<?php echo $codigo; ?>"> <?php echo $nombre; ?>:</label>
                    <input type="number" name="<?php echo 'max_inscripciones_' . $codigo; ?>" value="<?php echo $maximos_inscripciones[$codigo] ?? 100; ?>" required>
                    <br>
                <?php endforeach; ?>
                <button type="submit">Actualizar</button>
            </form>
        </div>
    </div>
    <h2>Lista de Alumnos Preinscritos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Domicilio</th>
            <th>Email</th>
            <th>Carrera</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?php echo $fila['ID_pre_inscripcion']; ?></td>
            <td><?php echo $fila['Nombre']; ?></td>
            <td><?php echo $fila['Apellido']; ?></td>
            <td><?php echo $fila['Documento']; ?></td>
            <td><?php echo $fila['Domicilio']; ?></td>
            <td><?php echo $fila['Email']; ?></td>
            <td><?php echo obtener_iniciales($fila['Carrera']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
