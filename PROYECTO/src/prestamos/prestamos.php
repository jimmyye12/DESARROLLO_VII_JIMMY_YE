<?php
class prestamos
{
    public $id_prestamo;
    public $id_usuarios;
    public $libro;
    public $fecha_prestamo;
    public $fecha_devolucion;
    public $estado;
    public $nombre;


    // Constructor para crear un objeto Task a partir de un array de datos
    public function __construct($data)
    {
        $this->id = $data['id_usuarios'];
        $this->title = $data['titulo'];
        $this->cedula = $data['cedula'];
        $this->email = $data['email'];
        $this->contraseña = $data['contraseña'];
        $this->telefono = $data['telefono'];
    }

    // Aquí podrían añadirse métodos adicionales relacionados con una tarea individual
}