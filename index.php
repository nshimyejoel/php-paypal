<?php
$url_path = isset($_GET['url']) ? $_GET['url'] : '';

$url = parse_url($url_path)['path'];

$routes = [
    '' => 'welcome.php',
    'home' => 'home.php',
    'about' => 'about.php',
    'charge' => 'charge.php',
    'cancel' => 'cancel.php',
    'success' => 'success.php',
];


if (array_key_exists($url,$routes)){
    require $routes[$url];
}else{
    http_response_code(404);
}
