<?php

/**
 * Summary of LearnhubUtils
 * Clase que provee atributos y metodos estaticos a otras clases
 */
class LearnhubUtils{

    public static string $platform_version = "1.0.0";

    private function __construct()
    {
    }

    public static function getPlatformVersion(): string
    {
        return self::$platform_version;
    }

    public static function formatPrice(float $price): string
    {
        return "$" . number_format($price, 2, ".", ",");
    }

    public static function formatDuration(int $hours): string
    {
        return $hours . " " . ($hours === 1 ? "hora" : "horas");
    }

    public static function createSlug(string $text): string
    {
        $slug = strtolower(trim($text));
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug) ?? "";
        return trim($slug, "-");
    }

    public static function isValidEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}