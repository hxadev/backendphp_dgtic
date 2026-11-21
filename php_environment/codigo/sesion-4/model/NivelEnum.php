<?php

/**
 * Summary of NivelEnum
 * 
 * Enum nos representa valores constantes lo cuales pueden referenciar
 * a data maestra
 * Contexto Static
 */
enum NivelEnum: int{ // Varios Comportamientos -> Devolver Int | string -> Polimorfismo
    case Basico = 1;
    case Intermedio = 2;
    case Avanzando = 3;

    public function obtenerEtiqueta(): string{
        $etiqueta = match($this){
            NivelEnum::Basico => "BASIC",
            NivelEnum::Intermedio => "MIDDLE",
            NivelEnum::Avanzando => "ADVANCED",
        };

        return $etiqueta;

    }
}

NivelEnum::Basico->value; // 1
NivelEnum::Intermedio->obtenerEtiqueta(); // MIDDLE

echo NivelEnum::Basico->value;
echo NivelEnum::Basico->obtenerEtiqueta();