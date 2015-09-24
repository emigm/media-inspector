<?php

namespace PhotoInspector\Instagram;

use PhotoInspector\Domain;
use PhotoInspector\Exception;
use PhotoInspector\RESTAdapter;
use PhotoInspector\Utils;

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

        try {
            $response = $this->rest_client->get($uri, $query);
        } catch (Exception\ClientException $ex) {
            throw new \Exception("Error getting media info by Client Error");
        } catch (Exception\ServerException $ex) {
            throw new \Exception("Error getting media info by Server Error");
        }

        $decoded_response = json_decode($response, true);

        $id = (isset($decoded_response['data']['id'])) ? $decoded_response['data']['id'] : NULL;
        $type = (isset($decoded_response['data']['type'])) ? $decoded_response['data']['type'] : NULL;

        if (!is_null($decoded_response['data']['location'])) {
            $geo_point = new Utils\GeoPoint(
                $decoded_response['data']['location']['latitude'],
                $decoded_response['data']['location']['longitude']);
        } else {
            $geo_point = NULL;
        }

        $media = new Media($id, $type, $geo_point);

        return $media;
    }
}
