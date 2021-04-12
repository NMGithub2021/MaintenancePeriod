<?php

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

function heder301(string $url){
    header($_SERVER['SERVER_PROTOCOL']." 301 Moved Permanently");
    header("Location: $url" );
}



function parseUrl(string $url, array $routes): array{
    $res = [
        'controller' => 'errors/e404', 
        'params' => []
    ];

    foreach ($routes as $route){
        $matches = [];
        if(preg_match($route['test'], $url, $matches)){

            $res['controller'] = $route['controller'];

            if(isset($route['params'])){
                foreach($route['params'] as $name => $num){
                    $res['params'][$name] = $matches[$num];
                }
            }
            
            break;
        }
    }
    
    return $res;
}


function getUriParts(string $uri) : array{
    $parts = explode('?', $uri);
    
    return [
        'url' => $parts[0] ?? '',
        'get' => $parts[1] ?? '',
    ];
}

function hasDoubleSlashes(string $uri) : bool{
    $pattern = '/\/{2,}/';
    return !!preg_match($pattern, $uri);
}