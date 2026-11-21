<?php

require_once(__DIR__ . "/LearnhubUtils.php");
require_once(__DIR__ . "/model/NivelEnum.php");
require_once(__DIR__ . "/model/Curso.php");
require_once(__DIR__ . "/model/CalculadorCostos.php");



// -> Acceso a atributos/metodos de clase
// :: Acceso a atributs/metodos del contexto static


/***
 * Clase para poder representar un Curso}
 * Abstraccion OO
 */


/**
 * Summary of CalculadorCostos
 * Clase encargada de calcular los costos de los cursos
 * 
 * // Relacion entre clases -> Relacion
 * // Composición
 * // Dependencia
 * // Herencia
 * // Implementacion 
 */


// Objeto
// Instancia de clase -> Objeto
$miCurso = new Curso();

// Clases Utilitarias/Crosscuting
Curso::$version; // Acceso a atributos y metodos estaticos, no es necesaria una instancia/objeto
echo "\n";

echo $miCurso->mostrarInformacionCurso();

// Objeto puede Mutar
$miCurso->setTitulo("Programacion con Java EE");
$miCurso->setDescripcion("Curso de programacion empresarial con Java 25");
$miCurso->setDuracion(80);
$miCurso->setPrecio(100);

echo "\n";
echo "\n";
echo $miCurso->mostrarInformacionCurso();

echo "\nInicializando el calculador de costos...\n";

// Representacion de relacion entre objetos
$miCalculador = new CalculadorCostos($miCurso);
$precioBrutoDelCurso = $miCalculador->calcularCostoBrutoCursoTexto();
//$nivelCurso=$miCurso->getNivel();


echo "El precio bruto del curso es  {$precioBrutoDelCurso}";
//echo "El nivel del curso es {$nivelCurso->value}";
