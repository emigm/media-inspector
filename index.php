<?php

require_once __DIR__.'/vendor/autoload.php'; 

use Silex\Application;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\RouteCollection;

$app = new Application();

$app['routes'] = $app->extend(
    'routes', function (RouteCollection $routes, Application $app) {
        $loader = new YamlFileLoader(new FileLocator(__DIR__.'/config'));
        $collection = $loader->load('routes.yml');
        $routes->addCollection($collection);
 
        return $routes;
});

$app->run();
