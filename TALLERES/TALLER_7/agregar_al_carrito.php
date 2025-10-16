<?php
session_start(); 
require_once __DIR__.'/producto_data.php';

$productos = productos();  

$id = $_POST['id'] ?? '';
$cantidad = $_POST['cantidad'] ?? 0;

function &carrito(): array {
    if (!isset($_SESSION['carrito']) || !is_array($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }
    return $_SESSION['carrito'];
}

if (isset($_SESSION['carrito'][$id])) {

    $_SESSION['carrito'][$id] += $cantidad;
} else {

    $_SESSION['carrito'][$id] = $cantidad;
}


header('Location: ver_carrito.php');
exit;
