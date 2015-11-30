<?php

require 'vendor/autoload.php';

$app = require 'app.php';

try {
    $route = trim(@$_GET['route'], '/') ?: 'index';
    
    echo $app->render($route);
}  catch (Bloge\NotFoundException $e) {
    header('HTTP/1.1 404 Not Found');
    
    echo $app->render('404');
}