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

//Aritmeticos +, -, /, %, **, *
// Comparacion == Valor === Tipo,Valor
// Asignacion = .=
// Ternario

$detallesEstudiante= "";

$apellidoEstudiante= "Hernandez";
$detallesEstudiante .= "Alfonso ";

$detallesEstudiante .= $apellidoEstudiante;

// Alfonso Hernández

var_dump($detallesEstudiante);
echo "900" == $precio, PHP_EOL;
echo "900" === $precio;

//var_dump(8 <=> 10);

// Operadores Nulabilidad ?? ?: Falsy

$responsable = null;

$precio = 0;

//echo $responsable ?? "EMPTY", PHP_EOL;
//echo $precio ?: "ZERO";

$precio = 150;
var_dump($precio);

$precio += 50; // 200
var_dump($precio);

$precio *= 2; // 400
var_dump($precio);

$precio /= 3; // 400
var_dump($precio);