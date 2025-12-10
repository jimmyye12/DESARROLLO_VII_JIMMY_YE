<?php
class prestamosManager {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection(); // Conectar a la base de datos
    }

    // Registrar un préstamo
    public function registrarPrestamo($id_usuario, $id_libro, $fecha_prestamo, $fecha_devolucion) {
        $sql = "INSERT INTO prestamos (id_usuario, id_libro, fecha_prestamo, fecha_devolucion)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id_usuario, $id_libro, $fecha_prestamo, $fecha_devolucion]);
    }

    // Obtener los préstamos de un usuario (opcional, si lo necesitas en el dashboard)
    public function obtenerPrestamosPorUsuario($id_usuario) {
        $sql = "SELECT * FROM prestamos WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstadoPrestamo($id_prestamo, $estado) {
    $sql = "UPDATE prestamos SET estado = ? WHERE id_prestamo = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$estado, $id_prestamo]);
}

}