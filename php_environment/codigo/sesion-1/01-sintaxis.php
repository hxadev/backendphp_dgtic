<?php

declare(strict_types=1);

echo "<h1>Hola a todos, bienvenidos a Learnhub!</h1>";
echo "<br>";

const EDICION = "2026.beta-01";
$responsable = 'Fernando Cortez';
$tituloCurso = "Programación en PHP - Experto: $responsable - Ed: " . EDICION; // string -> Interpolation
$descripcionCurso = "Curso de programación en PHP"; //string => .

// Númerico
$precio = 900; // Entero - Integer
$iva = 0.16; // Punto Flotante - float
$duracion = 8; // hrs - Entero - Integer
$precioFinal = ($precio * $iva) + $precio;


// Booleanos
$activo = false; // boolean

// Null
//$precio = null;

// array - Arreglo Iterativo
$categorias = ["Programcion Web", "Desarrollo de Software", "Backend"];

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

$categoriaSeleccionada = $categoriasAsociadas[0]['nombre'];
$descripcionCategoriaAsociada = $categoriasAsociadas[0]["descripcion"];

// Concatenacion => .
$muestraCurso = " Titulo: " . $tituloCurso . " - Descripcion: " . $descripcionCurso;

echo "<p>$muestraCurso - " . EDICION . "</p>";
echo "<p> Responsable del curso: $responsable </p>";

echo "<h2>Descripción del curso</h2>";
echo "<div style='background-color:#e3e3e3;'>";
echo "<br>";
echo "<p>Titulo: $tituloCurso</p>";
echo "<p>Precio: $precio</p>";
echo "<p>Categoria: $categoriaSeleccionada - $descripcionCategoriaAsociada</p>";
echo "</div>";
