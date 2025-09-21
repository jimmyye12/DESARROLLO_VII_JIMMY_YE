<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Gerente extends Empleado implements Evaluable {
    private $departamento;
    private $bono = 0;

    public function __construct($Nombre, $ID_empleado, $Salario_base, $departamento) {
        parent::__construct($Nombre, $ID_empleado, $Salario_base);
        $this->departamento = $departamento;
    }

    public function asignarBono($monto) {
        $this->bono = $monto;
    }

    public function getSalarioTotal() {
        return $this->getSalario_base() + $this->bono;
    }

    public function obtenerInformacion() {
        return "Gerente: {$this->getNombre()} (ID: {$this->getID_empleado()}), Salario: {$this->getSalario_base()}, Departamento: {$this->departamento}, Bono: {$this->bono}";
    }

    public function evaluarDesempenio() {
        return "El gerente {$this->getNombre()} ha gestionado bien el departamento de {$this->departamento}.";
    }
}
