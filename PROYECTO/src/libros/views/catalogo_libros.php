<?php
session_start();
include_once '../libros/librosManager.php'; // Incluir el modelo para los libros

//if (!isset($_SESSION['id_usuario'])) {
//    header("Location:  /DESARROLLO_VII_JIMMY_YE/PROYECTO/src/usuarios/views/login.php");  // Usamos __DIR__ para la ruta correcta
//exit();
//}

// Obtener todos los libros
$librosManager = new librosManager();
$libros = $librosManager->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="../../public/assets/styles.css"> <!-- Asegúrate de agregar tu archivo de estilos -->
</head>
<body>
    <h1>Catálogo de Libros</h1>

    <a href="nuevo_libro.php" class="btn btn-primary">Añadir Nuevo Libro</a>

    <table border = 1>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>cantidad de paginas</th>
                <th>genero</th>
                <th>acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
            <tr>
                <td><?php echo $libro->titulo; ?></td>
                <td><?php echo $libro->autor; ?></td>
                <td><?php echo $libro->cantidad_paginas; ?></td>
                <td><?php echo $libro->genero; ?></td>
                <td>
                    
                    <a href="solicitar_prestamo.php?id=<?php echo $libro->id_libro; ?>" class="btn btn-request">Solicitar Préstamo</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
