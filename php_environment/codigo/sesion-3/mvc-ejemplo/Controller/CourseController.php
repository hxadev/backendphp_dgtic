<?php

/**
 * LearnhubView <-> CourseController -> Model 
 */

function index(array $courses){
    // Llamando LearnhubView.render();
    $courses = getCourses(); // MODEL
    render("listCourses",$courses);
}

function detailCourse(array $courses){
    echo "Detalle Curso";    
}

function defaultCourse(){
    echo "Curso por defecto";
}