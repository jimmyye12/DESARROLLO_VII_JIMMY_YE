<?php
require_once 'validaciones.php';
require_once 'sanitizacion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $datos = [];

    // Procesar y validar cada campo
    $campos = ['nombre', 'email', 'edad', 'sitio_web', 'genero', 'intereses', 'comentarios', 'date'];
    foreach ($campos as $campo) {
        if (isset($_POST[$campo])) {
            $valor = $_POST[$campo];
            $funcionSanitizacion = "sanitizar" . ucfirst($campo); // Generamos el nombre de la función de sanitización
            if (function_exists($funcionSanitizacion)) {
                $valorSanitizado = call_user_func($funcionSanitizacion, $valor); // Llamamos a la función de sanitización
                $datos[$campo] = $valorSanitizado;

                // Validar el valor después de sanitizar
                if (!call_user_func("validar" . ucfirst($campo), $valorSanitizado)) {
                    $errores[] = "El campo $campo no es válido.";
                }
            } else {
                $errores[] = "Función de sanitización no encontrada para el campo $campo.";
            }
        }
    }

    // Calcular la edad 
    if (isset($_POST['date'])) {
        $fechaNacimiento = $_POST['date'];
        $fechaNacimiento = new DateTime($fechaNacimiento);
        $fechaActual = new DateTime();
        $edad = $fechaActual->diff($fechaNacimiento)->y;
        $datos['edad'] = $edad; 

    // Procesar la foto de perfil
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] !== UPLOAD_ERR_NO_FILE) {
        if (!validarFotoPerfil($_FILES['foto_perfil'])) {
            $errores[] = "La foto de perfil no es válida.";
        } else {
            $rutaDestino = 'uploads/' . basename($_FILES['foto_perfil']['name']);
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $rutaDestino)) {
                $datos['foto_perfil'] = $rutaDestino;
            } else {
                $errores[] = "Hubo un error al subir la foto de perfil.";
            }
        }
    }

    // Mostrar resultados o errores
    if (empty($errores)) {
        echo "<h2>Datos Recibidos:</h2>";
        echo "<table border='1'>";
        foreach ($datos as $campo => $valor) {
            echo "<tr>";
            echo "<th>" . ucfirst($campo) . "</th>";
            if ($campo === 'intereses') {
                echo "<td>" . implode(", ", $valor) . "</td>";
            } elseif ($campo === 'foto_perfil') {
                echo "<td><img src='$valor' width='100'></td>";
            } else {
                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>Errores:</h2>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}

echo "<br><a href='formulario.html'>Volver al formulario</a>";
}
?>