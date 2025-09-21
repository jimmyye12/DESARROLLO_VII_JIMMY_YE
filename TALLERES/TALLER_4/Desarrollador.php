<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';

class Desarrollador extends Empleado implements Evaluable {
    private $lenguajePrincipal;
    private $nivelExperiencia;

    public function __construct($nombre, $id_empleado, $salario_base, $lenguajePrincipal, $nivelExperiencia) {
        parent::__construct($nombre, $id_empleado, $salario_base);
        $this->lenguajePrincipal = $lenguajePrincipal;
        $this->nivelExperiencia = $nivelExperiencia;
    }

    public function getLenguajePrincipal() {
        return $this->lenguajePrincipal;
    }

    public function getNivelExperiencia() {
        return $this->nivelExperiencia;
    }

    public function obtenerInformacion() {
        return "Desarrollador: {$this->getNombre()} | ID: {$this->getID_empleado()} | Lenguaje: {$this->getLenguajePrincipal()} | Nivel: {$this->getNivelExperiencia()} | Salario: {$this->getSalario_base()}";
    }

    public function evaluarDesempenio() {
        return "El desarrollador {$this->getNombre()} con nivel {$this->getNivelExperiencia()} en {$this->getLenguajePrincipal()} ha cumplido con los objetivos asignados.";
    }
}
