<?php
require 'database.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);

     if (isset($_SESSION['producto_no_eliminado'])) {
        echo "<p style='color:red'>" . $_SESSION['producto_no_eliminado'] . "</p>";
        unset($_SESSION['producto_no_eliminado']);
    }

if ($stmt->execute()) {
    $_SESSION['producto_eliminado'] = "producto eliminado correctamente.";
    header("Location: index.php");

} else {
    $_SESSION['producto_no_eliminado'] = "Error al eliminar el producto: " . $stmt->error;
    header("Location: index.php");
}

    $stmt->close();
} else {
    echo "ID no proporcionado.";
}

$conexion->close();
?>