<?php
require 'database.php';

$nombre = $_POST['nombre'];
$categoria   = $_POST['categoria'];
$precio =$_POST['precio'];
$cantidad = $_POST['cantidad'];

$stmt = $conexion->prepare("INSERT INTO productos (nombre, categoria, precio, cantidad) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssdi", $nombre, $categoria, $precio, $cantidad);

session_start();

if ($stmt->execute()) {
    $_SESSION['producto_insertado'] = "producto añadido correctamente.";
    header("Location: index.php");

} else {
    $_SESSION['producto_no_insertado'] = "Error al añadir el producto: " . $stmt->error;
    header("Location: crear.php");
}
