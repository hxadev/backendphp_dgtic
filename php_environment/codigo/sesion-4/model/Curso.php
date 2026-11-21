<?php

require_once __DIR__ . "/NivelEnum.php";
require_once __DIR__ . "/Parseable.php";
// WorkShop es un Curso OK
// una clase puede implementar una interfaz
class Curso implements Parseable
{

    // Atributos de clase / Propiedades de clase
    // [visibilidad] [tipoDato] [nombre]
    // private -> Encapsulamiento
    // public -> Visibilidad general- > todos tienen acceso a esta propiedad
    // protected -> Herencia -> una clase padre puede permitir el acceso de sus propiedades a las clases hijas. 
    protected string $titulo;
    private string $descripcion;
    private int $duracion;

    private float $precio;

    

    private NivelEnum $nivel;



    public static string $version = "v1.0";

    // Constructor: Inicializa el objeto de una clase



    // Metodos / Funciones -> Representan comportamiento
    // Metodos Negocio -> calcularIvaCurso, guardarEstadoInicialCurso, mostrarInformacionCurso
    // Metodos de Lectura y Escritura -> Getter , Setter
    public function mostrarInformacionCurso(): string
    {
        return "Titulo: {$this->titulo}\n"
            . "Descripcion: {$this->descripcion}\n"
            . "Duracion: {$this->duracion} horas";
    }

    public function setNivel(NivelEnum $nivel): void
    {
        $this->nivel = $nivel;
    }

    public function getNivel(): NivelEnum
    {
        return $this->nivel;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        // Reglas de validacion
        if (strlen($titulo) === 0) {
            throw new Exception("El titulo no puede estár vacio.");
        }

        $this->titulo = $titulo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getDuracion(): int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): void
    {
        $this->duracion = $duracion;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function toPayload(): array
    {
        return [
            "titulo" => $this->titulo,
            "descripcion" => $this->descripcion,
            "duracion" => $this->duracion,
            "precio" => $this->precio,
            "nivel" => $this->nivel->value,
            "nivelEtiqueta" => $this->nivel->obtenerEtiqueta()
        ];
    }

    public function toPayloadJson(): string{
        return json_encode([]);
    }
}

$curso = new Curso();
