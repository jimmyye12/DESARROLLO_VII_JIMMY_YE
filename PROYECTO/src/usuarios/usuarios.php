<?php
class usuarios
{
    public $id_usuario;
    public $nombre;
    public $apellido;
    public $cedula;
    public $email;
    public $contraseña;
    public $membresia_id;

    // Constructor para crear un objeto Task a partir de un array de datos
    public function __construct($data)
    {
        $this->id = $data['id_usuario'];
        $this->nombre = $data['nombre'];
        $this->cedula = $data['cedula'];
        $this->email = $data['email'];
        $this->contraseña = $data['contraseña'];
        $this->membresia_id = $data['membresia_id'];
    }

    // Aquí podrían añadirse métodos adicionales relacionados con una tarea individual
}