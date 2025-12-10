<?php
class usuariosManager
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function crearUsuario($nombre, $apellido, $cedula,$contraseña, $email, $membresia_id)
    {
        $sql = "INSERT INTO libros (nombre, apellido, cedula, contraseña, email, membresia_id) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$nombre, $apellido, $cedula,$contraseña, $email, $membresia_id]);
    }

    public function deleteUsuarios($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function verificarLogin($email, $contraseña) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && $usuario['contraseña'] === $contraseña) {
            return $usuario;
        }
        
        return null;
    }
}