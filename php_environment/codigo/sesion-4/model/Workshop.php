<?php

class Workshop extends Curso{
   public function dinamicaWorkshop():void{

   }
}


$miWorkshop = new Workshop();

$miWorkshop->setTitulo("Mi Workshop IA");
$miWorkshop->dinamicaWorkshop();

// Polimorfismo -> Multiples formas
$miWorkshop = new Curso();