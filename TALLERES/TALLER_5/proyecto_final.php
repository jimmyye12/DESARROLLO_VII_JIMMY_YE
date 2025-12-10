<?php
$archivo = "estudiantes.json";
$data = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $data = json_decode($contenido, true) ?? [];
}

$estudiantes = $data['estudiantes'] ?? [];
$graduados = $data['graduados'] ?? [];

$opcion = $_GET['opcion'] ?? null;

function mostrarMenu() {
    echo "<h2>=== SISTEMA DE GESTIÓN DE ESTUDIANTES ===</h2>";
    echo "<ul>";
    echo "<li><a href='?opcion=1'>1. Agregar estudiante</a></li>";
    echo "<li><a href='?opcion=2'>2. Listar estudiantes</a></li>";
    echo "<li><a href='?opcion=3'>3. Buscar estudiante por carrera</a></li>";
    echo "<li><a href='?opcion=4'>4. Obtener mejor estudiante</a></li>";
    echo "<li><a href='?opcion=5'>5. Generar reporte de rendimiento</a></li>";
    echo "<li><a href='?opcion=6'>6. Graduar estudiante</a></li>";
    echo "<li><a href='?opcion=7'>7. Ranking de estudiantes</a></li>";
    echo "<li><a href='?opcion=0'>0. Salir</a></li>";
    echo "</ul>";
}

function guardarJSON($archivo, $data) {
    file_put_contents($archivo, json_encode($data, JSON_PRETTY_PRINT));
}


function estudianteValido($e) {
    return isset($e['nombre'], $e['edad'], $e['carrera'], $e['promedio']);
}


switch ($opcion) {

    case "1": 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nuevoId = (count($estudiantes) > 0) ? max(array_keys($estudiantes)) + 1 : 1;
            $nuevo = [
                "id" => $nuevoId,
                "nombre" => $_POST['nombre'],
                "edad" => (int) $_POST['edad'],
                "carrera" => $_POST['carrera'],
                "materias" => [], 
                "promedio" => (float) $_POST['nota'],
                "flags" => []
            ];
            $data['estudiantes'][$nuevoId] = $nuevo;
            guardarJSON($archivo, $data);

            echo "<p>Estudiante agregado con éxito.</p>";
            echo "<a href='proyecto_final.php'>Volver al menú</a>";
        } else {
            echo "<h3>Agregar Estudiante</h3>
                <form method='POST'>
                    Nombre: <input type='text' name='nombre' required><br><br>
                    Edad: <input type='number' name='edad' min='1' required><br><br>
                    Carrera: <input type='text' name='carrera' required><br><br>
                    Promedio: <input type='number' step='0.01' name='nota' min='0' max='100' required><br><br>
                    <button type='submit'>Guardar</button>
                </form>";
        }
        break;

    case "2": 
        echo "<h3>Lista de Estudiantes</h3><ul>";
        foreach ($estudiantes as $id => $e) {
            if (estudianteValido($e)) {
                echo "<li>{$e['id']} - {$e['nombre']} ({$e['carrera']}) - Promedio: {$e['promedio']}</li>";
            }
        }
        echo "</ul><a href='proyecto_final.php'>Volver al menú</a>";
        break;

    case "3": 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $carrera = $_POST['carrera'];
            echo "<h3>Estudiantes en la carrera: {$carrera}</h3><ul>";
            $encontrados = false;
            foreach ($estudiantes as $e) {
                if (estudianteValido($e) && strtolower($e['carrera']) == strtolower($carrera)) {
                    echo "<li>{$e['id']} - {$e['nombre']} - Promedio: {$e['promedio']}</li>";
                    $encontrados = true;
                }
            }
            if (!$encontrados) echo "<li>No se encontraron estudiantes</li>";
            echo "</ul><a href='proyecto_final.php'>Volver al menú</a>";
        } else {
            echo "<h3>Buscar por carrera</h3>
                <form method='POST'>
                    Carrera: <input type='text' name='carrera' required>
                    <button type='submit'>Buscar</button>
                </form>";
        }
        break;

    case "4": 
        $mejor = null;
        foreach ($estudiantes as $e) {
            if (estudianteValido($e) && (!$mejor || $e['promedio'] > $mejor['promedio'])) {
                $mejor = $e;
            }
        }
        if ($mejor) {
            echo "<h3>Mejor Estudiante</h3>";
            echo "<p>{$mejor['nombre']} ({$mejor['carrera']}) - Promedio: {$mejor['promedio']}</p>";
        } else {
            echo "<p>No hay estudiantes registrados.</p>";
        }
        echo "<a href='proyecto_final.php'>Volver al menú</a>";
        break;

    case "5": 
        echo "<h3>Reporte de Rendimiento</h3>";
        foreach ($estudiantes as $e) {
            if (estudianteValido($e)) {
                $estado = $e['promedio'] >= 60 ? "Aprobado" : "Reprobado";
                echo "<p>{$e['nombre']} ({$e['carrera']}) - Promedio: {$e['promedio']} - {$estado}</p>";
            }
        }
        echo "<a href='proyecto_final.php'>Volver al menú</a>";
        break;

    case "6": 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            if (isset($data['estudiantes'][$id])) {
                $data['graduados'][] = $data['estudiantes'][$id];
                unset($data['estudiantes'][$id]);
                guardarJSON($archivo, $data);
                echo "<p> Estudiante graduado/eliminado.</p>";
            } else {
                echo "<p> No se encontró el estudiante con ese ID.</p>";
            }
            echo "<a href='proyecto_final.php'>Volver al menú</a>";
        } else {
            echo "<h3>Graduar Estudiante</h3>
                <form method='POST'>
                    ID del estudiante: <input type='number' name='id' min='1' required>
                    <button type='submit'>Graduar</button>
                </form>";
        }
        break;

    case "7": 
        $ranking = $estudiantes;
        usort($ranking, fn($a,$b)=>$b['promedio'] <=> $a['promedio']);
        echo "<h3>Ranking de Estudiantes</h3><ol>";
        foreach ($ranking as $e) {
            echo "<li>{$e['id']} - {$e['nombre']} ({$e['carrera']}) - Promedio: {$e['promedio']}</li>";
        }
        echo "</ol><a href='proyecto_final.php'>Volver al menú</a>";
        break;

    case "0":
        echo "<h3> Gracias por usar el sistema</h3>";
        break;

    default:
        mostrarMenu();
        break;
}
?>
