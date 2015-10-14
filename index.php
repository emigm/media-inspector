<?php

namespace MediaInspector;

require_once __DIR__.'/vendor/autoload.php'; 

use MediaInspector\Exception;
use \Silex;
use Symfony\Component\HttpFoundation\Request;

$app = new \Silex\Application();

$app->get('/media/', function() use($app) {
    return $app->json(['error' => 'Invalid Request'], 400);
});

$app->get('/media/{id}/', function($id, Request $request) use($app) {
    try {
        $authorization_header = $request->headers->get('Authorization');

        if (strpos($authorization_header, 'Bearer') === false and
            strpos($authorization_header, 'bearer') === false ) {
            return $app->json(['error' => 'Invalid Token'], 401);
        }

        $access_token = substr($authorization_header, strlen('bearer '));

        $media_inspector = MediaInspectorFactory::create($access_token);
        $media_info = $media_inspector->getMediaInfo($id);
    } catch (Exception\ClientException $ex) {
        return $app->json(['error' => $ex->getMessage()], 400);
    } catch(\Exception $ex) {
        return $app->json(['error' => $ex->getMessage()], 500);
    }

    return $app->json($media_info->toArray(), 200); 
}); 

$app->run();
