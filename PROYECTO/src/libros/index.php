<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', dirname(dirname(__DIR__)) . '/');

require_once BASE_PATH . 'config.php';

require_once BASE_PATH . 'src/Database.php';
require_once __DIR__ . '/librosManager.php';
require_once __DIR__ . '/libros.php';

if (!class_exists('librosManager')) {
    die('Error: La clase librosManager no se cargó correctamente');
}
if (!class_exists('libros')) {
    die('Error: La clase libros no se cargó correctamente');
}

$librosManager = new librosManager();

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $titulo = $_POST['titulo'];
            $autor = $_POST['autor'] ;
            $isbn = $_POST['isbn'];
            $fecha_publicacion = $_POST['fecha_publicacion'];
            $genero = $_POST['genero'] ?? '';
            $cantidad_paginas = $_POST['cantidad_paginas'];

            if (!empty($titulo) && !empty($isbn)) {
                $librosManager->crearLibro($titulo, $autor, $isbn, $fecha_publicacion, $genero, $cantidad_paginas);
            }
            header('Location: ' . BASE_URL . "src/libros");
            exit;
        }
        require BASE_PATH . 'views/libros_form.php';
        break;

    case 'edit':
        $id = $_GET['id'] ?? null;

        if ($id && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
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