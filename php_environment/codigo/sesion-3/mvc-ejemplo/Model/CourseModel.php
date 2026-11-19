<?php

// Conexion a base de datos

function isCourseAvailable()
{
    return array_filter(getCourses(), fn($course) => $course["active"]);
}

function getCourseById(int $courseId)
{
    $courses = getCourses();
    return array_filter($courses, fn($course) => $course["id"] === $courseId);
}


// SELECT * FROM Courses
function getCourses(): array
{
    $cursos = require __DIR__ . "/../../../datos/cursos.php";
    return $cursos;
}
