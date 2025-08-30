<?php

for ($i = 1; $i <= 5; $i++) {

    for ($j = 1; $j <= $i; $j++) {
        echo "* ";
    }
    echo "<br>";
}

$numero = 1;
while ($numero <= 20) {
    if ($numero % 2 != 0) { 
        echo $numero . " ";
    }
    $numero++;
}
 echo "<br>";

$contador = 10;
do {
    if ($contador == 5) {
        $contador--;
        continue;    
    }
    echo $contador . " ";
    $contador--;
} while ($contador >= 1);
 echo "<br>";


$colores = ["Rojo", "Verde", "Azul", "Amarillo"];

foreach ($colores as $color) {
    if ($color == "Azul") {
        echo $color . " (mi favorito)<br>";
    } else {
        echo $color . "<br>";
    }
}
?>
