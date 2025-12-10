<?php
$registros_json = file_get_contents('registros.json');
$registros = json_decode($registros_json, true);

echo "<h2>Resumen de Registros</h2>";
echo "<table border='1'>";
echo "<tr><th>Nombre</th><th>Fecha de Nacimiento</th><th>Edad</th><th>Email</th><th>Intereses</th><th>Foto de Perfil</th></tr>";

foreach ($registros as $registro) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($registro['nombre']) . "</td>";
    echo "<td>" . htmlspecialchars($registro['fecha_nacimiento']) . "</td>";
    echo "<td>" . htmlspecialchars($registro['edad']) . "</td>";
    echo "<td>" . htmlspecialchars($registro['email']) . "</td>";
    echo "<td>" . implode(", ", $registro['intereses']) . "</td>";
    echo "<td><img src='" . htmlspecialchars($registro['foto_perfil']) . "' width='100' height='100'></td>";
    echo "</tr>";
}
echo "</table>";
?>
