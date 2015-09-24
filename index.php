<?php

namespace PhotoInspector;

require_once __DIR__.'/vendor/autoload.php'; 

$app = new \Silex\Application(); 

$app->get('/media/{id}', function($id) use($app) { 
    return 'Media '.$app->escape($id); 
}); 

$app->run();
