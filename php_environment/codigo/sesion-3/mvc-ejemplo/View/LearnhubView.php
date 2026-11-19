<?php


// Incluimos templates

function render(string $view ,array $courses){
    
    require __DIR__ ."/template/header.php";
    require __DIR__ ."/template/$view.php";
    require __DIR__ ."/template/footer.php";
}
