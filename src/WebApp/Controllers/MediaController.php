<?php

namespace WebApp\Controllers;

use MediaInspector;
use MediaInspector\Exception;
use Symfony\Component\HttpFoundation\Request;


class MediaController
{
    protected $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function getAllMedia()
    {
        return $this->app->json(['error' => 'Invalid Request'], 400);
    }

    public function getMediaById(Request $request, $id)
    {
        try {
            $authorization_header = $request->headers->get('Authorization');

            if (strpos($authorization_header, 'Bearer') === false and
                strpos($authorization_header, 'bearer') === false ) {
                return $this->app->json(['error' => 'Invalid Token'], 401);
            }

            $access_token = substr($authorization_header, strlen('bearer '));

            $media_inspector = MediaInspector\MediaInspectorFactory::create(
                $access_token);
            $media_info = $media_inspector->getMediaInfo($id);
        } catch (Exception\ClientException $ex) {
            return $this->app->json(['error' => $ex->getMessage()], 400);
        } catch(\Exception $ex) {
            return $this->app->json(['error' => $ex->getMessage()], 500);
        }

        return $this->app->json($media_info->toArray(), 200);
    }
}
