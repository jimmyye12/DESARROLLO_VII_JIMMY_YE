<?php
require 'database.php';

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();
?>

<h2>Editar producto</h2>
    <form action="actualizar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $productos['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="" required><br><br>
        <label for="categoria">categoria:</label>
        <input type="text" id="categoria" name="categoria" value="" required><br><br>
        <label for="precio">precio:</label>
        <input type="money" id="precio" name="precio" value="" required><br><br>
        <label for="cantidad">cantidad:</label>
        <input type="number" id="cantidad" name="cantidad" value="" required><br><br>
        <input type="submit" value="Actualizar producto">




</form>