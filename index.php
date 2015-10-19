<?php

require_once __DIR__.'/vendor/autoload.php'; 

use Silex\Application;
use Silex\Provider;
use Symfony\Component\HttpFoundation\Request;
use WebApp\Controllers;

$app = new Application();

$app->register(new Provider\ServiceControllerServiceProvider());

$app['media.controller'] = $app->share(function() use ($app) {
    return new Controllers\MediaController($app);
});

$app->get('/media/', "media.controller:getAllMedia");
$app->get('/media/{id}/', "media.controller:getMediaById");

$app->run();
