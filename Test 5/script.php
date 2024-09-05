<?php

// Función para calcular el tiempo mínimo necesario para que los robots presionen los botones dados en orden.
function calculateTime($sequence) {
    $orangePos = 1; 
    $bluePos = 1; 
    $time = 0; 

    // Calcula cantidad de elementos en el array 
    $count = count($sequence);

    // Itera sobre cada acción en el array $sequence
    for ($i = 0; $i < $count; $i++) {
        $action = $sequence[$i];
        $robot = $action[0]; // 'O' u 'B'
        $button = intval($action[1]); // Posición del botón convertida a entero

        // Calcular tiempo para que el robot alcance el botón
        if ($robot === 'O') {
            $time += abs($button - $orangePos) + 1; // Agregar 1 segundo por presionar el botón
            $orangePos = $button; // Actualizar posición de Orange
        } else {
            $time += abs($button - $bluePos) + 1; // Agregar 1 segundo por presionar el botón
            $bluePos = $button; // Actualizar posición de Blue
        };
    };

    return $time;
};

// Lectura de la entrada / número de casos
$cases = intval(trim(fgets(STDIN))); 

// Iterar sobre cada caso
for ($i = 1; $i <= $cases; $i++) {
    $input = explode(" ", trim(fgets(STDIN))); // Leer la secuencia de botones
    array_shift($input); // Eliminar el primer elemento (número de botones)
    
    $sequence = array_chunk($input, 2); // Dividir el array en pares de [robot, botón]
    
    $time = calculateTime($sequence); // Calcular el tiempo mínimo necesario
    echo "Case #$i: $time\n"; // Imprimir el resultado
};
?>