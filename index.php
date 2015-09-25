<?php

namespace MediaInspector;

use MediaInspector\Exception;

require_once __DIR__.'/vendor/autoload.php'; 

$app = new \Silex\Application(); 
$app->get('/media/{id}', function($id) use($app) {
    try {
        // $authorization_header = $app->request->headers->get('Authorization');

        // $app['monolog']->addInfo(sprintf("Authorization: '%s'", $authorization_header));

        // if (strpos($authorization_header, 'Bearer') === false or
        //     strpos($authorization_header, 'bearer') === false ) {
        //     return $app->json('Invalid Token', 401);
        // }

        // $access_token = substr($authorization_header, 0, strlen('bearer '));
        $access_token = '37946071.de0b35a.4ad6041a05454637ad4f04f80f530841';

        $media_inspector = MediaInspectorFactory::create($access_token);
        $media_info = $media_inspector->getMediaInfo($id);
    } catch (Exception\ClientException $ex) {
        return $app->json($ex->getMessage(), 400);
    } catch(\Exception $ex) {
        return $app->json($ex->getMessage(), 500);
    }

    return $app->json($media_info->toArray(), 200); 
}); 

$app->run();
