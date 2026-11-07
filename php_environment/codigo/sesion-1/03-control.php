<?php

const EDICION = "2026.beta-01";
$responsable = 'Fernando Cortez';
$tituloCurso = "Programación en PHP - Experto: $responsable - Ed: " . EDICION; // string -> Interpolation
$descripcionCurso = "Curso de programación en PHP"; //string => .

// Númerico
$precio = 900; // Entero - Integer
$iva = 0.16; // Punto Flotante - float
$duracion = 8; // hrs - Entero - Integer
$precioFinal = ($precio * $iva) + $precio;

// array - Arreglo Iterativo
$categorias = ["PWEB", "DSOFT", "BACK", "IA"];

// Array Asociativo => MAP => Key : Value
$categoriasAsociadas = [
    [
        "id" => 1,
        "nombre" => "Programacion Web",
        "descripcion" => "Categoria especializada en desarrollo y programacion web",
        "activo" => true
    ],
    [
        "id" => 2,
        "nombre" => "Diseño de Agentes de AI",
        "descripcion" => "Categoria especializada en Inteligencia Artificial",
        "activo" => true
    ]
];

/**
 * Operadores Logicos
 * AND &&
 * OR. ||
 * NOT !
 */

// IF
echo $precioFinal;
if ($precioFinal <= 1000) {
    echo "<h3>Precio normal</h3>";
} elseif ($precioFinal > 1000 && $precioFinal <= 5000) {
    echo "<h3>Precio Elevado</h3>";
} else {
    echo "<h3>Precio justo</h3>";
}

// SWITCH
$categoriaSeleccionada = $categorias[0];
/*switch ($categoriaSeleccionada) {
    case "DSOFT":
        $precioFinal += 100;
        break;
    case "PWEB":
    case "BACK":
        $precioFinal += 500;
        break;
    case "IA":
        $precioFinal += 1000;
        break;

}*/

$precioIncrementado = match($categoriaSeleccionada){
        "DSOFT" => 100,
        "PWEB", "BACK" => 500,
        "IA" => 1000,
        default => 0
};

$precioFinal += $precioIncrementado;

echo "<h3>Precio Final del curso $ $precioFinal</h3>";
