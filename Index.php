<?php

include_once('ini.php');


$pageCanonical = HOST . BASE_URL;
$urlParts = getUriParts($_SERVER['REQUEST_URI']);
$uri = $urlParts['url'];
$badUrl = BASE_URL . 'index.php';

//Убираем лишние слэши и делаем 301 редирект
if(hasDoubleSlashes($uri)){
	$redirectUrl = preg_replace('/\/{2,}/', '/', $uri);
	
	if($uriParts['get'] !== ''){
		$redirectUrl .= '?' . $uriParts['get'];
	}

    heder301($redirectUrl);
    exit();
}


if(strpos($uri, $badUrl) === 0){
    // Не даем на прямую вбить в адресной строке index.php и делаем 301 редирект
    heder301(BASE_URL);
    exit();
}else{
    $routes = include('routes.php');
    $url = $_GET['querysystemurl'] ?? '';
    $routerRes = parseUrl($url, $routes);
    $cname =  $routerRes['controller'];
    define('URL_PARAMS', $routerRes['params']);

    $urlLen = strlen($url);

    if($urlLen > 0 && $url[$urlLen-1] == '/'){
        $url = substr($url, 0, $urlLen - 1);
    }
    $pageCanonical .= $url;
}


$patch = "controllers/$cname.php";
$pageTitle = $pageContent = '';



if(!file_exists($patch)){
    $cname = 'errors/e404';
    $patch = "controllers/$cname.php";
   
}

include_once($patch);


$html = template('base/v_main', [
    'title' => $pageTitle,
    'content' => $pageContent,
    'canonical' => $pageCanonical
]);

echo $html;

