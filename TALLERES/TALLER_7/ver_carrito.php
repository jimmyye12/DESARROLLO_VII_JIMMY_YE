<?php
require_once __DIR__.'/producto_data.php';

session_start();

$productos = productos();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Carrito</title>
</head>
<body>
  <h1>carrito</h1>

  <?php if (empty($carrito)): ?>
      <p>El carrito está vacío.</p>
  <?php else: ?>
      <table border="1">
          <tr>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Subtotal</th>
              <th>Eliminar</th>
          </tr>
          <?php foreach ($carrito as $id => $cantidad): 
              if (isset($productos[$id])) {
                  $nombre = $productos[$id]['nombre'];
                  $precio = $productos[$id]['precio'];
                  $subtotal = $precio * $cantidad;
                  $total += $subtotal;
              } else {
                  continue; 
              }
          ?>
          <tr>
              <td><?= $nombre ?></td>
              <td><?= $cantidad ?></td>
              <td>$<?= number_format($precio, 2) ?></td>
              <td>$<?= number_format($subtotal, 2) ?></td>
              <td>

                <form action="eliminar_del_carrito.php" method="post">
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <button type="submit">Eliminar</button>
                </form>
              </td>
          </tr>
          <?php endforeach; ?>
          <tr>
              <td colspan="3"><strong>Total</strong></td>
              <td><strong>$<?= number_format($total, 2) ?></strong></td>
          </tr>
      </table>
  <?php endif; ?>

  <p><a href="productos.php">Seguir comprando</a></p>
  <p><a href="checkout.php">checkout</a></p>
</body>
</html>
