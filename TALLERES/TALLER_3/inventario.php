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
    echo "=== Resumen del Inventario ===\n";
    foreach ($inventario as $producto) {
        echo "Producto: {$producto['nombre']} | Precio: \$" . number_format($producto['precio'], 2) . " | Cantidad: {$producto['cantidad']}\n";
    }
    echo "\n";
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

    echo "=== Informe de Stock Bajo (menos de 5 unidades) ===\n";
    if (empty($bajo)) {
        echo "No hay productos con stock bajo.\n";
    } else {
        foreach ($bajo as $producto) {
            echo "⚠️ {$producto['nombre']} | Cantidad: {$producto['cantidad']}\n";
        }
    }
    echo "\n";
}


$archivo = "inventario.json";


$inventario = leerInventario($archivo);


ordenarInventario($inventario);


mostrarResumen($inventario);

$total = calcularValorTotal($inventario);
echo "=== Valor total del Inventario ===\n";
echo "Total: \$" . number_format($total, 2) . "\n\n";

informeStockBajo($inventario);

?>
