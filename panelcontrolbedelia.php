<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control de Bedelia</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('https://media.lacapital.com.ar/p/3ef5662c2dbfb07f35a8c28c46627aad/adjuntos/203/imagenes/005/944/0005944959/642x0/smart/los-alumnos-la-escuela-secundaria-n49-gral-jj-urquiza-protestaron-y-abandonador-el-establecimiento-foto-s-toriggino.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: white;
            text-shadow: 2px 2px 4px black;
            font-size: 36px;
            margin-bottom: 50px;
        }
        .boton {
            display: block;
            width: 300px;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            background-color: blue;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            margin: 10px 0;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            transition: background 0.3s, transform 0.2s;
        }
        .boton:hover {
            background-color: darkblue;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <h1>Panel de Control de Bedelia</h1>

    <a href="registroalumnos.php" class="boton">Registro alumnos inscriptos</a>
    <a href="registromaterias.php" class="boton">Registro materias</a>
    <a href="actdesactinscripciones.php" class="boton">Activar/Desactivar inscripciones</a>

</body>
</html>
