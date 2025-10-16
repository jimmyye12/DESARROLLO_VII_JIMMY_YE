
<?php
require_once __DIR__.'/producto_data.php';
session_start();

$productos = productos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
</head>
<body>
   <?php if(!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
} else ?>

    <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
    <h1>Lista de Productos</h1>
    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>cantidad</th>
        </tr>
        <?php foreach ($productos as $id => $producto): ?>
        <tr>
            <td><?= $producto['nombre'] ?></td>
            <td>$<?= number_format($producto['precio'], 2) ?></td>
            <td>
                <form action="agregar_al_carrito.php" method="post">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="number" name="cantidad" value="0" min="1" required>
                    <button type="submit">Agregar al carrito</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="ver_carrito.php">Ver carrito</a></p>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>