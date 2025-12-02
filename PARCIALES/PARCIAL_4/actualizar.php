<?php
require 'database.php';

$id      = $_POST['id'];
$nombre  = $_POST['nombre'];
$categoria  = $_POST['categoria'];
$precio    = $_POST['precio'];
$cantidad    = $_POST['cantidad'];


$stmt = $conexion->prepare("UPDATE productos SET nombre = ?, categoria = ?, precio = ?, cantidad = ? WHERE id = ?");
$stmt->bind_param("ssdii", $nombre, $categoria, $precio,$cantidad, $id);

if ($stmt->execute()) {
    echo "producto actualizado correctamente.";
    echo "<br><a href='index.php'>Volver a la lista</a>";
} else {
    echo "Error al actualizar: " . $stmt->error;
}
