<?php
session_start();
$inscripcion_materias = $_SESSION['inscripcion_materias'] ?? "habilitar";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos Segundo y Tercer Año</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            margin-bottom: 20px;
        }
        .container a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Alumnos/Recursantes de Segundo y Tercer Año</h1>
        <a href="<?= $inscripcion_materias === 'habilitar' ? 'inscripcionamaterias2.php' : 'inscripcioncerrada.php' ?>">Inscripción a Materias</a>
        <a href="inscripcionamesadeexamenes.php">Inscripción a Mesa de Exámenes</a>
    </div>
</body>
</html>
