<?php

/**
 * 
 * Contrato para parsear/convertir objetos
 * // Alta Cohesion
 * // Bajo Acoplamiento
 * // Reutilizacion
 */
interface Parseable{
    function toPayload(): array;
    function toPayloadJson(): string;
}