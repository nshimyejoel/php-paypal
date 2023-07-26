<?php

$url = parse_url($_GET['url'] ?? '')['path'];

$routes = [
    '' => 'welcome.php',
    'home' => 'home.php',
    'about' => 'about.php',
    'charge' => 'charge.php',
    'cancel' => 'cancel.php',
    'success' => 'success.php',
];

require $routes[$url] ?? http_response_code(404);
