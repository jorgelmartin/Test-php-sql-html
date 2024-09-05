<?php

// Función para obtener detalles de un libro por su identificador
function getDetailsBooks($identifier) {
    // Construir la URL de búsqueda para el identificador dado
    $url = "https://openlibrary.org/search.json?q=" . urlencode($identifier);

    // Hacer la solicitud HTTP a la API de búsqueda
    $jsonResponse = file_get_contents($url);
    $responseData = json_decode($jsonResponse, true);

    // Verificar si se encontraron resultados
    if (isset($responseData['docs']) && $responseData['docs']) {
        // Tomar el primer resultado
        $result = $responseData['docs'][0];

        // Construir y devolver los detalles del libro
        return [
            'title' => $result['title'] ?? 'Desconocido',
            'authors' => $result['author_name'] ?? 'Desconocido',
            'number_of_pages' => $result['number_of_pages_median'] ?? 'Desconocido'
        ];
    } else {
        return "No se encontraron detalles para el identificador proporcionado.";
    }
}

// Identificadores de los libros
$identifiers = [
    'isbn:0201558025',
    'lccn:93005405',
    'isbn:0385472579',
    'lccn:62019420'
];

// Obtener detalles de cada libro
$detailsBooks = array_map('getDetailsBooks', $identifiers);

// Imprimir los detalles de los libros como una lista de datos
for ($i = 0; $i < count($detailsBooks); $i++) {
    $details = $detailsBooks[$i];
    echo "<div>";
    echo "<div><strong>Título:</strong> " . $details['title'] . "</div>";
    echo "<div><strong>Autores:</strong> " . (is_array($details['authors']) ? implode(", ", $details['authors']) : $details['authors']) . "</div>";
    echo "<div><strong>Número de páginas:</strong> " . $details['number_of_pages'] . "</div>";
    echo "</div><br>";
}
?>