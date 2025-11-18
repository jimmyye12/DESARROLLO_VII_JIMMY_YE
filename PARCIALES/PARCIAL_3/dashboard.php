<?php
session_start();
require 'datos.php';

if (!isset($_SESSION['usuario'], $_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}



$usuarioActual = $_SESSION['usuario'];
$rolActual     = $_SESSION['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($usuarioActual); ?></h2>
    <p>Rol: <?php echo htmlspecialchars($rolActual); ?></p> 
    <a href="logout.php">cerrar sesión</a>
    <hr>

    <?php if ($rolActual === 'PROFESOR'): ?>
        <h3>Listado de estudiantes y calificaciones</h3>
        <table border="1">
            <tr>
                <th>Estudiante</th>
                <th>Calificación</th>
            </tr>
            <?php foreach ($usuarios as $usuario => $datos): ?>
                <?php if ($datos['rol'] === 'ESTUDIANTE'): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario); ?></td>
                        <td><?php echo htmlspecialchars($datos['nota']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>

    <?php elseif ($rolActual === 'ESTUDIANTE'): ?>
        <h3>Mi calificación</h3>
        <?php
        $datosEstudiante = $usuarios[$usuarioActual] ?? null;
        if ($datosEstudiante && isset($datosEstudiante['nota'])) {
            echo "<p>Tu calificación es: <strong>" . htmlspecialchars($datosEstudiante['nota']) . "</strong></p>";
        } else {
            echo "<p>no se encontró la calificación.</p>";
        }
        ?>
    <?php else: ?>
        <p>Rol no reconocido.</p>
    <?php endif; ?>

</body>
</html>
