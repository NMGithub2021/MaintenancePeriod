<?php
//Проверяет коректность именни контроллера
function checkContrillerName(string $name): bool{
    return (bool)preg_match('/^[a-z0-9-]+$/', $name);
}

//Функция генерации разметки в некоторых шаблонизаторах имеет название render
//Генерирует разметку по переданому пути к шаблону view и попутно подставляет туда переменные кторые там необходимы
function template(string $path, array $vars = []) : string{
    $systemTemplateRenererIntoFullPath = "views/$path.php"; 
    extract($vars);
    ob_start();
    include($systemTemplateRenererIntoFullPath);
    return ob_get_clean();
}

//Нужно вызывать перед отображением ошибки 404 чтобы SEO робот не индексировал нашу страницу 
//Здесь просто происходит отправка HTTP заголовка 
function heder404(){
    header($_SERVER['SERVER_PROTOCOL']." 404 Not Found");
}