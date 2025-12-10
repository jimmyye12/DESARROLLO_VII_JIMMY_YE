<?php
session_start();
require_once __DIR__ . '/../usuariosManager.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $cedula = trim($_POST['cedula']);
    $email = trim($_POST['email']);
    $contraseña = $_POST['contraseña'];
    $membresia = $_POST['membresia'] ?? 'bronce';

    $membresia_id = 1;
    if ($membresia === 'plata')
        $membresia_id = 2;
    if ($membresia === 'oro')
        $membresia_id = 3;

    $usuarioManager = new usuariosManager();
    
    $resultado = $usuarioManager->crearUsuario($nombre, $apellido, $cedula, $email, $contraseña, $membresia_id);

    if ($resultado) {
        $mensaje = "¡Registro exitoso! Ahora puedes iniciar sesión.";
    } else {
        $mensaje = "Error al registrar el usuario. Intenta de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body>
    <h1>Registro de Usuario</h1>

    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Apellido:</label><br>
        <input type="text" name="apellido" required><br><br>

        <label>Cédula:</label><br>
        <input type="text" name="cedula" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contraseña" required><br><br>

        <label>Membresía:</label><br>
        <select name="membresia">
            <option value="bronce">Bronce (1 semana)</option>
            <option value="plata">Plata (2 semanas)</option>
            <option value="oro">Oro (3 semanas)</option>
        </select><br><br>

        <button type="submit">Registrarme</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
</body>

</html>