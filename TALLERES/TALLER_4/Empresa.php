<?php
require_once 'Gerente.php';
require_once 'Desarrollador.php';

class Empresa {
    private $empleados = [];

    public function agregarEmpleado(Empleado $empleado) {
        $this->empleados[] = $empleado;
    }

    public function listarEmpleados() {
        foreach ($this->empleados as $empleado) {
            echo $empleado->obtenerInformacion() . PHP_EOL;
        }
    }

    public function calcularNominaTotal() {
        $total = 0;
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Gerente) {
                $total += $empleado->getSalarioTotal();
            } else {
                $total += $empleado->getSalario_base();
            }
        }
        return $total;
    }

    public function evaluarEmpleados() {
        foreach ($this->empleados as $empleado) {
            if ($empleado instanceof Evaluable) {
                echo $empleado->evaluarDesempenio() . PHP_EOL;
            }
        }
    }
}
