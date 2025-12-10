<?php
class librosManager
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
    public function obtenerTodos()
    {
        $stmt = $this->db->query("SELECT * FROM libros ORDER BY titulo ASC");
        $libros_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $lista_libros = [];
        foreach ($libros_data as $data) {
       
            $lista_libros[] = new libros($data);
        }
        return $lista_libros;
    }

    public function obtenerPorId($id_libro)
    {
        $stmt = $this->db->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $stmt->execute([$id_libro]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return new libros($data); 
        }
        return null;
    }

    public function crearLibro($titulo, $autor, $isbn, $fecha_publicacion, $genero, $cantidad_paginas)
    {
        $sql = "INSERT INTO libros (titulo, autor, isbn, fecha_publicacion, genero, cantidad_paginas) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$titulo, $autor, $isbn, $fecha_publicacion, $genero, $cantidad_paginas]);
    }

    public function actualizarLibro($id_libro, $titulo, $autor, $isbn)
    {
        $sql = "UPDATE libros SET titulo = ?, autor = ?, isbn = ? WHERE id_libro = ?";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$titulo, $autor, $isbn, $id_libro]);
    }

    public function eliminarLibro($id_libro)
    {
        $stmt = $this->db->prepare("DELETE FROM libros WHERE id_libro = ?");
        return $stmt->execute([$id_libro]);
    }
}