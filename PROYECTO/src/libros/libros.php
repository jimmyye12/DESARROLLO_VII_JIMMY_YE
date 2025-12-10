<?php
class libros
{
    public $id_libro;
    public $titulo;
    public $autor;
    public $isbn;
    public $fecha_publicacion;
    public $genero;
    public $cantidad_paginas;

    public function __construct(array $data)
    {

        $this->id_libro = $data['id_libro'] ;
        $this->titulo = $data['titulo'];
        $this->autor = $data['autor'];
        $this->isbn = $data['isbn'];
        $this->fecha_publicacion = $data['fecha_publicacion'];
        $this->genero = $data['genero'];
        $this->cantidad_paginas = $data['cantidad_paginas'];
    }

}