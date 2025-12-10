
<?php
$nombre_completo = "Jimmy Ye Qiu";
$edad = 23;
$correo_electronico = "jimmy.ye@utp.ac.pa";
$telefono = "6758-0547";

define("PROFESION", "Estudiante");

$presentacion = "Hola, mi nombre es " . $nombre_completo . " tengo " . $edad . " de edad y actualmente soy " . PROFESION . " en la carrera de Lic. en desarrollo de software.";
$contacto = "Si quiere contratarme en un trabajito para crear una app o hacer una pagina web no dudes en llamarme al: " . $telefono . " o al correo: " . $correo_electronico . "." ; 

echo $presentacion . "<br>";
echo $contacto . "<br>";
print ("<br>"."Muchas gracias.");

printf("<br>" . "<br>" . "En resumen: %s, %d años, %s, %s, %s<br>", $nombre_completo, $edad, $correo_electronico, $telefono, PROFESION);

echo "<br>Información de debugging:<br>";
var_dump($nombre_completo);
echo "<br>";
var_dump($edad);
echo "<br>";
var_dump($correo_electronico);
echo "<br>";
var_dump($telefono);
echo "<br>";
var_dump(PROFESION);
echo "<br>";
?>