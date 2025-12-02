
<?php
require_once "database.php";
session_start();
?>
        

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>LISTA DE PRODUCTOS</h1>
    <button>
        <a href="crear.php">Añadir producto</a>
    </button>

    <TABLE border = "1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>categoria</th>
            <th>Precio</th>
            <th>cantidad</th>
</tr>

 <?php
    if (isset($_SESSION['producto_insertado'])) {
        echo "<p style='color:green'>" . $_SESSION['producto_insertado'] . "</p>";
        unset($_SESSION['producto_insertado']);
    }

    if (isset($_SESSION['producto_eliminado'])) {
        echo "<p style='color:green'>" . $_SESSION['producto_eliminado'] . "</p>";
        unset($_SESSION['producto_eliminado']);
    }
    ?>

< <?php
        $sql = "SELECT * FROM productos";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td>" . $fila['id'] . "</td>";
                echo "<td>" . $fila['nombre'] . "</td>";
                echo "<td>" . $fila['categoria'] . "</td>";
                echo "<td>" . $fila['precio'] . "</td>";
                echo "<td>" . $fila['cantidad'] . "</td>";
                echo "<td>";
                echo "<a href='editar.php?id=" . $fila['id'] . "'>Editar</a> | ";
                echo "<a href='eliminar.php?id=" . $fila['id'] . "' onclick=\"return confirm('¿Seguro que deseas eliminar este usuario?');\">Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='5'>No se encontraron usuarios.</td></tr>";
        }
        ?>
    </table>
</body>
</html>