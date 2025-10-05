<?php
// Sanitizar nombre
function sanitizarNombre($nombre) {
    return filter_var(trim($nombre), FILTER_SANITIZE_FULL_SPECIAL_CHARS); // Usamos FULL_SPECIAL_CHARS en lugar de FILTER_SANITIZE_STRING
}

// Sanitizar fecha
function sanitizarFecha($fecha) {
    return htmlspecialchars(trim($fecha), ENT_QUOTES, 'UTF-8'); // Usamos htmlspecialchars para manejar caracteres especiales
}

// Sanitizar email
function sanitizarEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

// Sanitizar edad
function sanitizarEdad($edad) {
    return filter_var($edad, FILTER_SANITIZE_NUMBER_INT);
}

// Sanitizar sitio web
function sanitizarSitioWeb($sitioWeb) {
    return filter_var(trim($sitioWeb), FILTER_SANITIZE_URL);
}

// Sanitizar género
function sanitizarGenero($genero) {
    return filter_var(trim($genero), FILTER_SANITIZE_STRING); // Aunque FILTER_SANITIZE_STRING está deprecado, lo mantenemos para este campo
}

// Sanitizar intereses
function sanitizarIntereses($intereses) {
    return array_map(function($interes) {
        return filter_var(trim($interes), FILTER_SANITIZE_STRING);
    }, $intereses);
}

// Sanitizar comentarios
function sanitizarComentarios($comentarios) {
    return htmlspecialchars(trim($comentarios), ENT_QUOTES, 'UTF-8');
}
?>
