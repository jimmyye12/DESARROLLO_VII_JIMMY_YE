<?php
$cuota_base = "";
$antiguedad_meses =  6; 
function calcular_promocion($antiguedad_meses, $cuota_base) {
if ($antiguedad_meses >= 3 && $antiguedad_meses <= 12){

     $cuota_base*= 0.08;

}elseif ($antiguedad_meses >= 13 && $antiguedad_meses <= 24){
    
    $cuota_base*= 0.12;

}elseif ($antiguedad_meses >= 24){

    $cuota_base*= 0.20;

}

}

function calcular_seguro_medico($cuota_base){

$cuota_base *= 0.05;

}

function calcular_cuota_final($cuota_base, $descuento, $seguro_medico){

}

?>