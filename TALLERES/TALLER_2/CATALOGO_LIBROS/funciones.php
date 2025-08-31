<?php
function obtenerLibros() {
    return [
        [
            'titulo' => 'Harry Potter y la piedra filosofal',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 1997,
            'genero' => 'Fantasía',
            'descripcion' => 'El primer libro de la saga, donde Harry descubre que es un mago e ingresa a Hogwarts para iniciar su aventura.'
        ],
        [
            'titulo' => 'Harry Potter y la cámara secreta',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 1998,
            'genero' => 'Fantasía',
            'descripcion' => 'En su segundo año en Hogwarts, Harry debe enfrentarse al misterio de la Cámara de los Secretos y a una amenaza mortal para los estudiantes.'
        ],
        [
            'titulo' => 'Harry Potter y el prisionero de Azkaban',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 1999,
            'genero' => 'Fantasía',
            'descripcion' => 'Harry se enfrenta al misterio de Sirius Black, un prisionero fugado de Azkaban que aparentemente lo persigue.'
        ],
        [
            'titulo' => 'Harry Potter y el cáliz de fuego',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 2000,
            'genero' => 'Fantasía',
            'descripcion' => 'Harry participa en el Torneo de los Tres Magos, enfrentando pruebas peligrosas mientras Voldemort comienza a recuperar su poder.'
        ],
        [
            'titulo' => 'Harry Potter y la Orden del Fénix',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 2003,
            'genero' => 'Fantasía',
            'descripcion' => 'Harry y sus amigos forman el Ejército de Dumbledore para luchar contra la represión en Hogwarts y el regreso de Voldemort.'
        ],
        [
            'titulo' => 'Harry Potter y el misterio del príncipe',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 2005,
            'genero' => 'Fantasía',
            'descripcion' => 'Harry descubre más sobre el pasado de Voldemort mientras recibe la ayuda de un misterioso libro de pociones firmado por el Príncipe Mestizo.'
        ],
        [
            'titulo' => 'Harry Potter y las reliquias de la muerte',
            'autor' => 'J. K. Rowling',
            'anio_publicacion' => 2007,
            'genero' => 'Fantasía',
            'descripcion' => 'El final épico de la saga donde Harry, Ron y Hermione buscan los Horrocruxes para derrotar definitivamente a Voldemort.'
        ]
    ];
}

function mostrarDetallesLibro($libro) {
    $html  = "<div class='libro'>";
    $html .= "<h3>" . htmlspecialchars($libro['titulo']) . "</h3>";
    $html .= "<p><strong>Autor:</strong> " . htmlspecialchars($libro['autor']) . "</p>";
    $html .= "<p><strong>Año de publicación:</strong> " . htmlspecialchars($libro['anio_publicacion']) . "</p>";
    $html .= "<p><strong>Género:</strong> " . htmlspecialchars($libro['genero']) . "</p>";
    $html .= "<p><strong>Descripción:</strong> " . htmlspecialchars($libro['descripcion']) . "</p>";
    $html .= "</div>";
    return $html;
}
?>
