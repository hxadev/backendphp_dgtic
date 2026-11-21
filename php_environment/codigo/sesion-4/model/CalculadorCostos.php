<?php

class CalculadorCostos
{
    private Curso $curso;

    public function __construct(Curso $curso)
    {
        $this->curso = $curso;
    }

    /**
     * Metodo calcular Costo Bruto del curso tiene una tarea especifica.
     * @throws Exception
     * @return float|int
     */
    public function calcularCostoBrutoCurso(): float
    {
        $duracion = $this->curso->getDuracion();
        $precio = $this->curso->getPrecio();

        if ($duracion < 0) {
            throw new Exception("La duracion del curso no puede ser negativa.");
        }

        if ($precio < 0) {
            throw new Exception("El precio del curso no puede ser negativo.");
        }

        return ($duracion * $precio) + $this->calcularImpuesto();
    }

    public function calcularCostoBrutoCursoTexto(): string
    {
        return LearnhubUtils::formatPrice($this->calcularCostoBrutoCurso());
    }


    private function calcularImpuesto(): float
    {
        return $this->curso->getPrecio() * 0.16;
    }
}
