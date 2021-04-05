<?php

function checkContrillerName(string $name): bool{
    return (bool)preg_match('/^[a-z0-9-]+$/', $name);
}

function template(string $path, array $vars = []) : string{
    $systemTemplateRenererIntoFullPath = "views/$path.php"; 
    extract($vars);
    ob_start();
    include($systemTemplateRenererIntoFullPath);
    return ob_get_clean();
}