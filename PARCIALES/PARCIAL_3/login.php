<?php

session_start();
require 'datos.php';

$errores = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario    = trim($_POST['usuario'] ?? '');
    $contrasena = trim($_POST['contrasena'] ?? '');


    if ($usuario === '' || $contrasena === '') {
        $errores[] = "Debe ingresar el usuario y la contraseña";
    }

    if (!preg_match('/^[A-Za-z0-9]{3,}$/', $usuario)) {
        $errores[] = "El usuario debe contener e o más caracters y solo debe contener letras y números";
    }

    if (strlen($contrasena) < 5) {
        $errores[] = "La contraseña debe contener 5 o mas caracteres";
    }

    if (empty($errores)) {
        if (isset($usuarios[$usuario]) && $usuarios[$usuario]['password'] === $contrasena) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $usuarios[$usuario]['rol'];
            header("Location: dashboard.php");
            exit();
        } else {
            $errores[] = "Usuario o contraseña incorrectos.";
        }
    }
}

 if(isset($_SESSION['usuario'])) {
    header("Location: dashboard.php");
        exit();
} else

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>

    <?php if (!empty($errores)): ?>
        <ul style="color:red;">
            <?php foreach ($errores as $e): ?>
                <li><?php echo htmlspecialchars($e); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="">
        <label for="usuario">Nombre de usuario:</label><br>
        <input type="text" id="usuario" name="usuario"
               value="<?php echo isset($usuario) ? htmlspecialchars($usuario) : ''; ?>" required>
        <br><br>

        <label for="contrasena">Contraseña:</label><br>
        <input type="password" id="contrasena" name="contrasena" required>
        <br><br>

        <button type="submit">Acceder</button>
    </form>
</body>
</html>
