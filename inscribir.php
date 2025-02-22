<?php
session_start();
require_once './data_base/db_urquiza.php';

$success_message = '';
$materias_seleccionadas = $_SESSION['materias_seleccionadas'] ?? [];
$carrera_seleccionada_id = $_SESSION['carrera_seleccionada'] ?? '';
$carrera_seleccionada_nombre = '';

// Obtener el nombre de la carrera
if (!empty($carrera_seleccionada_id)) {
    $stmt = $conexion->prepare("SELECT nombre FROM carreras WHERE id = ?");
    $stmt->execute([$carrera_seleccionada_id]);
    $carrera = $stmt->fetch();
    $carrera_seleccionada_nombre = $carrera['nombre'] ?? 'Carrera desconocida';
}

// Obtener los nombres de las materias seleccionadas
$materias_nombres = [];
if (!empty($materias_seleccionadas)) {
    $placeholders = implode(',', array_fill(0, count($materias_seleccionadas), '?'));
    $stmt = $conexion->prepare("SELECT id, nombre FROM materias WHERE id IN ($placeholders)");
    $stmt->execute($materias_seleccionadas);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $materias_nombres[$row['id']] = $row['nombre'];
    }
}

// Si se envió el formulario, guardar los datos en la sesión sin redirigir
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
    $_SESSION['registro'] = [
        'nombre' => trim($_POST['nombre']),
        'apellido' => trim($_POST['apellido']),
        'documento' => trim($_POST['documento']),
        'direccion' => trim($_POST['direccion']),
        'email' => trim($_POST['email']),
        'carrera_id' => trim($_POST['carrera_id']),
        'tipo_estudiante' => trim($_POST['tipo_estudiante']),
        'materias' => $materias_seleccionadas
    ];
    $success_message = "Datos guardados correctamente.";
}

// Cargar los datos almacenados en la sesión para que no se pierdan al recargar la página
$nombre = $_SESSION['registro']['nombre'] ?? '';
$apellido = $_SESSION['registro']['apellido'] ?? '';
$documento = $_SESSION['registro']['documento'] ?? '';
$direccion = $_SESSION['registro']['direccion'] ?? '';
$email = $_SESSION['registro']['email'] ?? '';
$tipo_estudiante = $_SESSION['registro']['tipo_estudiante'] ?? '';

// Borrar la sesión si se presiona "Borrar todo"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrar'])) {
    session_unset();
    session_destroy();
    header("Location: inscribir.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de inscripción</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        form { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        label, button { display: block; margin-bottom: 10px; }
        input, select { width: 100%; padding: 10px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #ccc; }
        .success-message { background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-top: 20px; }
        .button-group { display: flex; gap: 10px; }
        .button-group button { flex: 1; padding: 10px; font-size: 16px; border: none; cursor: pointer; border-radius: 5px; }
        .btn-enviar { background-color: #90ee90; color: black; } /* Verde claro */
        .btn-borrar { background-color: #ffcccb; color: black; } /* Rojo claro */
        .btn-imprimir { background-color: #add8e6; color: black; } /* Azul claro */
    </style>
</head>
<body>

<h1>Formulario de inscripción</h1>

<form action="inscribir.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>" required>

    <label for="documento">Documento:</label>
    <input type="text" id="documento" name="documento" value="<?php echo htmlspecialchars($documento); ?>" required>

    <label for="direccion">Domicilio:</label>
    <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($direccion); ?>" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label for="carrera_id">Carrera:</label>
    <input type="text" id="carrera_nombre" value="<?php echo htmlspecialchars($carrera_seleccionada_nombre); ?>" disabled>
    <input type="hidden" name="carrera_id" value="<?php echo htmlspecialchars($carrera_seleccionada_id); ?>">

    <label>Tipo de Estudiante:</label>
    <input type="radio" id="cursante" name="tipo_estudiante" value="Cursante" <?php echo ($tipo_estudiante == "Cursante") ? "checked" : ""; ?> required>
    <label for="cursante">Cursante de segundo/tercer año</label>
    <input type="radio" id="recursante" name="tipo_estudiante" value="Recursante" <?php echo ($tipo_estudiante == "Recursante") ? "checked" : ""; ?> required>
    <label for="recursante">Recursante de primero/segundo/tercer año</label>

    <h3>Materias a las que se inscribe:</h3>
    <ul>
        <?php
        if (!empty($materias_seleccionadas)) {
            foreach ($materias_seleccionadas as $materia_id) {
                echo "<li>" . htmlspecialchars($materias_nombres[$materia_id] ?? "Materia desconocida") . "</li>";
            }
        } else {
            echo "<li>No se seleccionaron materias.</li>";
        }
        ?>
    </ul>

    <div class="button-group">
        <button type="submit" name="enviar" class="btn-enviar">Enviar</button>
        <button type="submit" name="borrar" class="btn-borrar">Borrar todo</button>
        <button type="button" onclick="window.print()" class="btn-imprimir">Imprimir comprobante</button>
    </div>
</form>

<?php if (!empty($success_message)): ?>
    <div class="success-message"><?php echo $success_message; ?></div>
<?php endif; ?>

</body>
</html>

