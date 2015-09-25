<?php

namespace MediaInspector\Instagram;

use MediaInspector\Domain;
use MediaInspector\Exception;
use MediaInspector\RESTAdapter;
use MediaInspector\Utils;

class MediaEndPoint implements Domain\iMedia
{
    const MEDIA_URI = '/v1/media/';

    private $rest_client;

    function __construct($access_token, $rest_client)
    {
        $this->access_token = $access_token;
        $this->rest_client = $rest_client;
    }

    public function getMedia($media_id)
    {
        $uri = self::MEDIA_URI.$media_id;
        $query = ['access_token' => $this->access_token];

        $response = $this->rest_client->get($uri, $query);
        $decoded_response = json_decode($response, true);

        $id = (isset($decoded_response['data']['id'])) ?
            $decoded_response['data']['id'] : NULL;
        $type = (isset($decoded_response['data']['type'])) ?
            $decoded_response['data']['type'] : NULL;

        $latitude = (isset($decoded_response['data']['location'])) ?
            $decoded_response['data']['location']['latitude'] : NULL;
        $longitude = (isset($decoded_response['data']['location'])) ?
            $decoded_response['data']['location']['longitude'] : NULL;
        $geo_point = new Utils\GeoPoint($latitude, $longitude);

        $media = new Media($id, $type, $geo_point);

        return $media;
    }
}
