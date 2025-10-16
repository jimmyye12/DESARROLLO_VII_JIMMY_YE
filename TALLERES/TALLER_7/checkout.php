<?php
require_once __DIR__ . '/config_sesion.php';   
require_once __DIR__ . '/producto_data.php';
require_once __DIR__ . '/csrf.php';

$productos = productos();
$carrito = carrito(); 

$subtotal = 0.0;
foreach ($carrito as $id => $qty) {
    if (isset($productos[$id])) {
        $subtotal += $productos[$id]['precio'] * (int)$qty;
    }
}
$total = $subtotal; 
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Checkout</title>
</head>
<body>
<h1>Checkout</h1>

<?php if (empty($carrito)): ?>
 <h1>Tu carrito está vacío. </h1> <a href="productos.php">Volver a productos</a>
  <?php exit; ?>
<?php endif; ?>

<h2>Resumen de la compra</h2>
<table border="1">
  <thead>
    <tr>
        <th>Cantidad</th>
        <th>Producto</th>
        <th>Precio</th>
        <th>Subtotal</th>
    </tr>
</thead>
  <tbody>
    <?php foreach ($carrito as $id => $cantidad):
      $p = $productos[$id];
      $sub = $p['precio'] * (int)$cantidad;
    ?>
    <tr>
     
      <td><?= (int)$qty ?></td>
      <td><?= $p['nombre'] ?></td>
      <td>$<?= number_format($p['precio'],2) ?></td>
      <td>$<?= number_format($sub,2) ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan="3"><strong>Total</strong></td>
      <td><strong>$<?= number_format($total,2) ?></strong></td>
    </tr>
  </tbody>
</table>

<h2>Datos de pago</h2>
<form action="pago.php" method="post">

    <label for="nombre">Nombre del titular</label>
    <input id="nombre" name="nombre" type="text" maxlength="100" required>

    <label for="tarjeta">Número de tarjeta</label>
    <input id="tarjeta" name="tarjeta" type="text" inputmode="numeric" pattern="[0-9\s]{13,19}" maxlength="19" placeholder="1111 2222 3333 4444" required>


    <label for="exp">Fecha de expiración (MM/AAAA)</label>
    <input id="exp" name="exp" type="month" required>

    <label for="cvv">CVV</label>
    <input id="cvv" name="cvv" type="text" inputmode="numeric" pattern="[0-9]{3,4}" maxlength="4" required>
    
    <button type="submit">Pagar $<?= number_format($total,2) ?></button>
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>">

    
</form>

</body>
</html>
