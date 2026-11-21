<?php

/**
 * 
 * PHP utiliza Herencia Simple 1-extends-1
 */
class Workshop extends Curso{
   public function dinamicaWorkshop():void{

   }
}


$miWorkshop = new Workshop();

$miWorkshop->setTitulo("Mi Workshop IA");
$miWorkshop->dinamicaWorkshop();

// Polimorfismo -> Multiples formas
$miWorkshop = new Curso();