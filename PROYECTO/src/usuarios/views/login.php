<?php
session_start();
require_once __DIR__ . '/../usuariosManager.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email']);
    $contraseña = $_POST['contraseña'];


    $usuariosManager = new usuariosManager();

    $usuario = $usuariosManager->verificarLogin($email, $contraseña);

    if ($usuario) {

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['membresia'] = $usuario['membresia_id'];

        header('Location: src/libros/index.php');
        exit();
    } else {

        $mensaje = "Correo o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>

<body>
    <h1>Login</h1>

    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Correo:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="contraseña" required><br><br>

        <button type="submit">Ingresar</button>
    </form>

    <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
</body>

</html>