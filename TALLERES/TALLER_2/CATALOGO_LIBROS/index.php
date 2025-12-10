<?php
require_once 'funciones.php';
include 'header.php'; 
$libros = obtenerLibros();
?>

<?php

foreach ($libros as $libro) {
    echo '<div class="libro">';
    echo mostrarDetallesLibro($libro);
    echo '</div>';
}
?>

<?php
include 'footer.php';
?>
