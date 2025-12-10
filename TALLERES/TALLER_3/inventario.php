<?php

function leerInventario($archivo)
{
    if (!file_exists($archivo)) {
        die("El archivo $archivo no existe.\n");
    }
    $contenido = file_get_contents($archivo);
    return json_decode($contenido, true);
}

function ordenarInventario(&$inventario)
{
    usort($inventario, function ($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
}

function mostrarResumen($inventario)
{
    echo "<h2> Resumen del Inventario</h2>";
    echo "<table border='1' cellspacing='0' cellpadding='8' style='border-collapse: collapse; width: 70%; text-align:center;'>";
    echo "<tr style='background:#f2f2f2;'>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
          </tr>";
    foreach ($inventario as $producto) {
        echo "<tr>
                <td>{$producto['nombre']}</td>
                <td>$" . number_format($producto['precio'], 2) . "</td>
                <td>{$producto['cantidad']}</td>
              </tr>";
    }
    echo "</table><br>";
}

function calcularValorTotal($inventario)
{
    return array_sum(array_map(function ($p) {
        return $p['precio'] * $p['cantidad'];
    }, $inventario));
}

function informeStockBajo($inventario)
{
    $bajo = array_filter($inventario, function ($p) {
        return $p['cantidad'] < 5;
    });

    echo "<h2> Informe de Stock Bajo (menos de 5 unidades)</h2>";
    if (empty($bajo)) {
        echo "<p style='color:green;'> No hay productos con stock bajo.</p>";
    } else {
        echo "<ul style='color:red;'>";
        foreach ($bajo as $producto) {
            echo "<li><b>{$producto['nombre']}</b> | Cantidad: {$producto['cantidad']}</li>";
        }
        echo "</ul>";
    }
}

$archivo = "inventario.json";
$inventario = leerInventario($archivo);
ordenarInventario($inventario);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario de Tienda</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 20px;">
    <h1> Sistema de Inventario</h1>

    <?php mostrarResumen($inventario); ?>

    <h2> Valor total del Inventario</h2>
    <p><b>Total:</b> $<?php echo number_format(calcularValorTotal($inventario), 2); ?></p>

    <?php informeStockBajo($inventario); ?>
</body>
</html>
