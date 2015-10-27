<?php

namespace WebApp\Controller;

use MediaInspector;
use MediaInspector\Exception;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class MediaController
{
    public function getAllMedia(Application $app)
    {
        return $app->json(['error' => 'Invalid Request'], 400);
    }

    public function getMediaById(Application $app, Request $request, $id)
    {
        try {
            $authorization_header = $request->headers->get('Authorization');

            if (strpos($authorization_header, 'Bearer') === false and
                strpos($authorization_header, 'bearer') === false ) {
                throw new Exception\UnauthorizedException('Invalid access token');
            }

            $access_token = substr($authorization_header, strlen('bearer '));

            $media_inspector = MediaInspector\MediaInspectorFactory::create(
                $access_token);
            $media_info = $media_inspector->getMediaInfo($id);
        } catch (Exception\UnauthorizedException $ex) {
            return $app->json(['error' => $ex->getMessage()], 401);
        } catch (Exception\ClientException $ex) {
            return $app->json(['error' => $ex->getMessage()], 400);
        } catch(\Exception $ex) {
            return $app->json(['error' => $ex->getMessage()], 500);
        }

        return $app->json($media_info->toArray(), 200);
    }
}
