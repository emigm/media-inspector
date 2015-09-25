<?php

namespace MediaInspector;

use MediaInspector\Google;
use MediaInspector\Instagram;
use MediaInspector\RESTAdapter;

class MediaInspectorFactory
{
    public static function create($access_token)
    {
        $google_api_key = getenv('GOOGLE_API_KEY');
        $google_end_point = getenv('GOOGLE_ENDPOINT');
        if (!$google_api_key or !$google_end_point) {
            throw new \Exception("Google is not configured");
        }

        $google_rest_client = new RESTAdapter\RESTClient($google_end_point);
        $google_maps = new Google\Maps($google_api_key, $google_rest_client);

        $instagram_end_point = getenv('INSTAGRAM_ENDPOINT');
        if (!$instagram_end_point) {
            throw new \Exception('Instagram is not configured');
        }

        $instagram_rest_client = new RESTAdapter\RESTClient(
            $instagram_end_point);
        $instagram_media_endpoint = new Instagram\MediaEndPoint(
            $access_token, $instagram_rest_client);

        return new MediaInspector($instagram_media_endpoint, $google_maps);
    }
}
