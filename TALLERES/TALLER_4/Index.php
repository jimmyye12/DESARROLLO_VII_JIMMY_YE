<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';
require_once 'Gerente.php';
require_once 'Desarrollador.php';
require_once 'Empresa.php';


$empresa = new Empresa();


$gerente1 = new Gerente("Laura Gómez", "G001", 2500, "Ventas");
$gerente1->asignarBono(500);

$dev1 = new Desarrollador("Carlos Pérez", "D001", 1500, "PHP", "Senior");
$dev2 = new Desarrollador("Ana Torres", "D002", 1200, "JavaScript", "Junior");


$empresa->agregarEmpleado($gerente1);
$empresa->agregarEmpleado($dev1);
$empresa->agregarEmpleado($dev2);


echo "=== Lista de Empleados ===" . PHP_EOL;
$empresa->listarEmpleados();


echo PHP_EOL . "Nómina Total: " . $empresa->calcularNominaTotal() . PHP_EOL;


echo PHP_EOL . "=== Evaluaciones de Desempeño ===" . PHP_EOL;
$empresa->evaluarEmpleados();
