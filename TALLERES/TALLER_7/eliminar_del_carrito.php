<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'] ?? null;

    if ($id && isset($_SESSION['carrito'][$id])) {
        
        unset($_SESSION['carrito'][$id]);

        header('Location: ver_carrito.php');
        exit;
    }
}
header('Location: ver_carrito.php');
exit;
