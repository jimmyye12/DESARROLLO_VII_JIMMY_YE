<?php
require_once "database.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    if (isset($_SESSION['producto_no_insertado'])) {
        echo "<p style='color:red'>" . $_SESSION['producto_no_insertado'] . "</p>";
        unset($_SESSION['producto_no_insertado']);
    }
    ?>

    <h1>añadir producto</h1>
    <form action="insertar.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="" required><br><br>
        <label for="correo">categoria:</label>
        <input type="text" id="categoria" name="categoria" value="" required><br><br>
        <label for="precio">precio:</label>
        <input type="money" id="precio" name="precio" value="" required><br><br>
        <label for="cantidad">cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="" required><br><br>
        <input type="submit" value="Añadir producto">




</body>

</html>