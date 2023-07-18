<?php

$url = isset($_GET['url']) ? $_GET['url'] : '';
switch ($url) {
    case '':
        require 'welcome.php';
        break;
    case 'home':
        require 'home.php';
        break;
    case 'about':
        require 'about.php';
        break;
    case 'charge':
        require 'charge.php';
        break;
    default:
        http_response_code(404);
        break;
}