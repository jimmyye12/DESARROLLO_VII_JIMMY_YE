<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(dirname(__DIR__)) . '/');

require_once BASE_PATH . 'config.php';

require_once BASE_PATH . 'src/Database.php';
require_once __DIR__ . '/usuariosManager.php';
require_once __DIR__ . '/usuarios.php';

if (!class_exists('usuariosManager')) {
  die('Error: La clase usuariosManager no se cargó correctamente');
}
if (!class_exists('usuarios')) {
  die('Error: La clase usuarios no se cargó correctamente');
}

$usuariosManager = new usuariosManager();

$action = $_GET['action'] ?? 'list';

switch ($action) {
  case 'create':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $cedula = $_POST['cedula'];
      $email = $_POST['email'];
      $contraseña = $_POST['contraseña'] ?? '';
      $membresia = $_POST['membresia_id'];

      if (!empty($email) && !empty($contraseña)) {
        $usuariosManager->crearUsuario($nombre, $apellido, $cedula, $contraseña, $email, $membresia);
      }
      header('Location: ' . BASE_URL . "src/usuarios");
      exit;
    }
    require BASE_PATH . 'views/login.php';
    break;

  case 'edit':
    $id = $_GET['id'] ?? null;

    if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') {
      $itulo = $_POST['titulo'] ?? '';
      $autor = $_POST['autor'] ?? '';
      $isbn = $_POST['isbn'] ?? '';

      if (!empty($titulo) && !empty($autor) && !empty($isbn)) {
        $librosManager->actualizarLibro($id, $titulo, $autor, $isbn);
      }
      header('Location: ' . BASE_URL . "src/libros");
      exit;
    } elseif ($id) {
      $libro = $librosManager->obtenerPorId($id);
      if ($libro) {
        require BASE_PATH . 'views/libros_edit.php';
      } else {
        header('Location: ' . BASE_URL);
      }
    }
    break;

  case 'delete':
    $id = $_GET['id'] ?? null;
    if ($id) {
      $librosManager->eliminarLibro($id);
    }
    header('Location: ' . BASE_URL . "src/libros");
    exit;

  default:
    $libros = $librosManager->obtenerTodos();

    require __DIR__ . '/views/catalogo_libros.php';
    break;
}

