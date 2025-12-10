<?php

class Empleado {
    private $nombre;
    private $id_empleado;
    private $salario_base;

    public function __construct($nombre, $id_empleado, $salario_base) {
        $this->setNombre($nombre);
        $this->setID_empleado($id_empleado);
        $this->setSalario_base($salario_base);
    }

    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = trim($nombre);
    }

    public function getID_empleado() {
        return $this->id_empleado;
    }
    public function setID_empleado($id_empleado) {
        $this->id_empleado = trim($id_empleado);
    }

    public function getSalario_base() {
        return $this->salario_base;
    }
    public function setSalario_base($salario_base) {
        $this->salario_base = floatval($salario_base);
    }

    public function obtenerInformacion() {
        return "Empleado: {$this->getNombre()} | ID: {$this->getID_empleado()} | Salario: {$this->getSalario_base()}";
    }
}
