<?php
/**
 * Sistema simple de gestión de inventario usando JSON
 * Autor: [Tu Nombre]
 * Ejecución: php inventario.php
 */

// -------------------- FUNCIONES --------------------

/**
 * Lee el inventario desde el archivo JSON
 */
function leerInventario($archivo)
{
    if (!file_exists($archivo)) {
        die("El archivo $archivo no existe.\n");
    }
    $contenido = file_get_contents($archivo);
    return json_decode($contenido, true);
}

/**
 * Ordena el inventario alfabéticamente por nombre
 */
function ordenarInventario(&$inventario)
{
    usort($inventario, function ($a, $b) {
        return strcmp($a['nombre'], $b['nombre']);
    });
}

/**
 * Muestra un resumen del inventario
 */
function mostrarResumen($inventario)
{
    echo "=== Resumen del Inventario ===\n";
    foreach ($inventario as $producto) {
        echo "Producto: {$producto['nombre']} | Precio: \$" . number_format($producto['precio'], 2) . " | Cantidad: {$producto['cantidad']}\n";
    }
    echo "\n";
}

/**
 * Calcula el valor total del inventario
 */
function calcularValorTotal($inventario)
{
    return array_sum(array_map(function ($p) {
        return $p['precio'] * $p['cantidad'];
    }, $inventario));
}

/**
 * Genera un informe de productos con stock bajo (menos de 5 unidades)
 */
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

// -------------------- SCRIPT PRINCIPAL --------------------

$archivo = "inventario.json";

// 1. Leer inventario
$inventario = leerInventario($archivo);

// 2. Ordenar inventario
ordenarInventario($inventario);

// 3. Mostrar resumen
mostrarResumen($inventario);

// 4. Calcular valor total
$total = calcularValorTotal($inventario);
echo "=== Valor total del Inventario ===\n";
echo "Total: \$" . number_format($total, 2) . "\n\n";

// 5. Informe de stock bajo
informeStockBajo($inventario);

?>
