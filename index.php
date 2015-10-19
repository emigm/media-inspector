<?php

require_once __DIR__.'/vendor/autoload.php'; 

$app = new \Silex\Application();

$app->get('/media/', 'WebApp\\Controllers\\MediaAPI::getAllMedia');
$app->get('/media/{id}/', 'WebApp\\Controllers\\MediaAPI::getMediaById');

$app->run();
