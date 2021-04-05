<?php


TEST STRING

=======
include_once('core/system.php');


$cname = $_GET['c'] ?? 'index';
$patch = "controllers/$cname.php";
$pageTitle = 'Ошибка 404';
$pageContent = '';



if(checkContrillerName($cname) && file_exists($patch)){
    include_once($patch);
}
else{
    $pageContent = template('errors/v_404');
}

$html = template('base/v_main', [
    'title' => $pageTitle,
    'content' => $pageContent
]);

echo $html;

