<?php
session_start(); // Iniciar sesión
require_once './data_base/db_urquiza.php';

$success_message = '';
$materias_seleccionadas = isset($_SESSION['materias_seleccionadas']) ? $_SESSION['materias_seleccionadas'] : [];
$materias_nombres = [];

// Obtener nombres de materias seleccionadas
if (!empty($materias_seleccionadas)) {
    $placeholders = implode(',', array_fill(0, count($materias_seleccionadas), '?'));
    $query = "SELECT id, nombre FROM materias WHERE id IN ($placeholders)";

    $stmt = $conexion->prepare($query);
    $stmt->execute($materias_seleccionadas);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $materias_nombres[$row['id']] = $row['nombre'];
    }
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['borrar_todo'])) {
        // Borrar datos de sesión
        session_unset();
        session_destroy();
        header("Location: inscribir.php");
        exit();
    }

    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $documento = $_POST['documento'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $email = $_POST['email'] ?? '';
    $tipo_estudiante = $_POST['tipo_estudiante'] ?? '';
    $carrera_id = $_POST['carrera_id'] ?? '';

    if ($nombre && $apellido && $documento && $direccion && $email && $tipo_estudiante && $carrera_id && !empty($materias_seleccionadas)) {
        // Guardar datos en sesión para enviarlos a registromaterias.php
        $_SESSION['registro'] = [
            'nombre' => $nombre,
            'apellido' => $apellido,
            'documento' => $documento,
            'direccion' => $direccion,
            'email' => $email,
            'tipo_estudiante' => $tipo_estudiante,
            'carrera_id' => $carrera_id,
            'materias' => $materias_seleccionadas
        ];
        header("Location: registromaterias.php");
        exit();
    } else {
        $success_message = "Por favor, complete todos los campos obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de inscripción</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn {
            background-color: #007bff;
            color: white;
        }
        .reset-btn {
            background-color: #dc3545;
            color: white;
        }
        .print-btn {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>

<h1>Formulario de inscripción</h1>

<form action="inscribir.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>"><br>
    
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" required value="<?php echo htmlspecialchars($_POST['apellido'] ?? ''); ?>"><br>
    
    <label for="documento">Documento:</label>
    <input type="text" id="documento" name="documento" required value="<?php echo htmlspecialchars($_POST['documento'] ?? ''); ?>"><br>
    
    <label for="direccion">Domicilio:</label>
    <input type="text" id="direccion" name="direccion" required value="<?php echo htmlspecialchars($_POST['direccion'] ?? ''); ?>"><br>
    
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"><br>
    
    <label>Tipo de Estudiante:</label><br>
    <input type="radio" id="cursante" name="tipo_estudiante" value="Cursante" required <?php if (isset($_POST['tipo_estudiante']) && $_POST['tipo_estudiante'] === "Cursante") echo "checked"; ?>>
    <label for="cursante">Cursante de segundo/tercer año</label><br>
    <input type="radio" id="recursante" name="tipo_estudiante" value="Recursante" required <?php if (isset($_POST['tipo_estudiante']) && $_POST['tipo_estudiante'] === "Recursante") echo "checked"; ?>>
    <label for="recursante">Recursante de primero/segundo/tercer año</label><br>
    
    <h3>Materias a las que se inscribe:</h3>
    <ul>
        <?php
        if (!empty($materias_seleccionadas)) {
            foreach ($materias_seleccionadas as $materia_id) {
                $nombre_materia = $materias_nombres[$materia_id] ?? "Materia desconocida";
                echo "<li>" . htmlspecialchars($nombre_materia) . "</li>";
            }
        } else {
            echo "<li>No se seleccionaron materias.</li>";
        }
        ?>
    </ul>

    <div class="button-group">
        <button type="submit" class="submit-btn">Enviar</button>
        <button type="submit" name="borrar_todo" class="reset-btn">Borrar todo</button>
        <button type="button" onclick="window.print()" class="print-btn">Imprimir comprobante</button>
    </div>
</form>

<?php if ($success_message): ?>
    <p class="success-message"><?php echo $success_message; ?></p>
<?php endif; ?>

</body>
</html>
