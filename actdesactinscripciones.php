<?php
session_start(); // Iniciar sesión

// Inicializar valores si no existen
if (!isset($_SESSION['inscripcion_carreras'])) {
    $_SESSION['inscripcion_carreras'] = "habilitar";
}
if (!isset($_SESSION['inscripcion_materias'])) {
    $_SESSION['inscripcion_materias'] = "habilitar";
}

// Manejar cambios en los switches
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['accion']) && isset($_POST['estado'])) {
        if ($_POST['accion'] === 'carreras') {
            $_SESSION['inscripcion_carreras'] = $_POST['estado'];
        } elseif ($_POST['accion'] === 'materias') {
            $_SESSION['inscripcion_materias'] = $_POST['estado'];
        }
    }
    exit(json_encode(["success" => true])); // Devolver respuesta JSON
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activar/Desactivar Inscripciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #444;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: 0 auto;
        }
        .card {
            background-color: #333;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }
        .toggle-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .switch-container {
            display: inline-block;
            position: relative;
            width: 60px;
            height: 30px;
        }
        .switch-container input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #888;
            transition: 0.3s;
            border-radius: 30px;
        }
        .slider::before {
            content: "";
            position: absolute;
            height: 26px;
            width: 26px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #28a745;
        }
        input:checked + .slider::before {
            transform: translateX(30px);
        }
    </style>
    <script>
        function cambiarEstado(accion) {
            let checkbox = document.getElementById(accion);
            let estado = checkbox.checked ? "habilitar" : "deshabilitar";

            // Enviar petición AJAX para actualizar sesión
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "actdesactinscripciones.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    console.log("Estado actualizado correctamente");
                }
            };
            xhr.send("accion=" + accion + "&estado=" + estado);
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Activar/Desactivar Inscripciones</h1>

    <div class="card">
        <div class="toggle-container">
            <span>Habilitar/Deshabilitar inscripción a carreras</span>
            <label class="switch-container">
                <input type="checkbox" id="carreras" <?= $_SESSION['inscripcion_carreras'] === "habilitar" ? "checked" : "" ?>
                       onchange="cambiarEstado('carreras')">
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <div class="card">
        <div class="toggle-container">
            <span>Habilitar/Deshabilitar inscripción a materias</span>
            <label class="switch-container">
                <input type="checkbox" id="materias" <?= $_SESSION['inscripcion_materias'] === "habilitar" ? "checked" : "" ?>
                       onchange="cambiarEstado('materias')">
                <span class="slider"></span>
            </label>
        </div>
    </div>

</div>

</body>
</html>
