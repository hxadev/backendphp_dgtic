<?php

require_once __DIR__ ."/Parseable.php";
require_once __DIR__ ."/Printable.php";

/**
 * 
 * Implementacion de interfaces
 * En php se implementa 1--implements--*
*/
class Student implements Parseable, Printable{
    public function toPayload(): array{
        return [];
    }
    public function toPayloadJson(): string{
        return json_encode($this->toPayload());
    }

    public function printDetails():void{
        echo "Detalles de la clase";
    }
}

// ClaseA -> ClaseB // Alta Acoplamiento
// ClaseA -> InterfaceB <- implements ClaseB