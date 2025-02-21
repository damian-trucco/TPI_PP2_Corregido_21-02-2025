<?php

session_start(); // Iniciar sesión

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['materias'])) {
    $_SESSION['materias_seleccionadas'] = $_POST['materias'];
    header("Location: inscribir.php");
    exit();
}

require_once './data_base/db_urquiza.php';

// Obtener la carrera seleccionada (por defecto 'Analista Funcional' con ID 1)
$carrera_id = isset($_GET['carrera_id']) ? $_GET['carrera_id'] : 1;

// Consultar el nombre de la carrera
$sql = "SELECT nombre FROM carreras WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$carrera_id]);
$carrera = $stmt->fetch();

// Consultar materias de la carrera seleccionada
$sql = "SELECT * FROM materias WHERE carrera_id = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$carrera_id]);
$materias = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción a Materias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            display: flex;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 75%;
        }

        h1, h2 {
            color: #333;
        }

        .materia {
            margin-bottom: 10px;
        }

        .year-container {
            border: 2px solid #333;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .year-title {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        aside {
            width: 25%;
            margin-left: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        aside img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .selector-container {
            margin-bottom: 20px;
        }

        .selector-container select {
            padding: 5px;
            font-size: 16px;
        }
        
        button {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Seleccione las materias que desea cursar/recursar</h1>

        <div class="selector-container">
            <form action="" method="GET">
                <label for="carrera">Carrera:</label>
                <select name="carrera_id" id="carrera" onchange="this.form.submit()">
                    <option value="1" <?= $carrera_id == 1 ? 'selected' : '' ?>>Analista Funcional</option>
                    <option value="2" <?= $carrera_id == 2 ? 'selected' : '' ?>>Desarrollador de Software</option>
                    <option value="3" <?= $carrera_id == 3 ? 'selected' : '' ?>>Infraestructura en TI</option>
                </select>
            </form>
        </div>

        <h2><?php echo htmlspecialchars($carrera['nombre']); ?></h2>
        <form action="inscripcionamaterias2.php" method="POST">
            <input type="hidden" name="carrera_id" value="<?php echo $carrera_id; ?>">

            <?php
            $years = [1 => 'Primer año', 2 => 'Segundo año', 3 => 'Tercer año'];
            foreach ($years as $year => $year_title) {
                $filtered_materias = array_filter($materias, function ($materia) use ($year) {
                    return $materia['anio'] == $year;
                });
                if (count($filtered_materias) > 0) {
                    echo "<div class='year-container'>";
                    echo "<div class='year-title'>{$year_title}</div>";
                    foreach ($filtered_materias as $materia) {
                        echo "<div class='materia'>";
                        echo "<input type='checkbox' name='materias[]' value='{$materia['id']}'> ";
                        echo htmlspecialchars($materia['nombre']) . " (Año {$materia['anio']})";
                        echo "</div>";
                    }
                    echo "</div>";
                }
            }
            ?>

            <button type="submit">Inscribirse</button>
        </form>
    </div>

    <aside>
        <?php if ($carrera_id == 1) { ?>
            <img src="https://terciariourquiza.edu.ar/wp-content/uploads/2023/08/image-2.png" alt="Analista Funcional">
        <?php } elseif ($carrera_id == 2) { ?>
            <img src="https://terciariourquiza.edu.ar/wp-content/uploads/2023/08/image-3.png" alt="Desarrollador de Software">
        <?php } elseif ($carrera_id == 3) { ?>
            <img src="https://terciariourquiza.edu.ar/wp-content/uploads/2023/08/image-4.png" alt="Infraestructura en TI">
        <?php } ?>
    </aside>
</body>

</html>
