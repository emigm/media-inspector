<?php

namespace PhotoInspector\Instagram;

use PhotoInspector\Domain;
use PhotoInspector\Exception;
use PhotoInspector\RESTAdapter;
use PhotoInspector\Utils;

class MediaInspector implements Domain\iMediaInfo
{
    const MEDIA_URI = '/v1/media/';

    private $rest_client;

    function __construct($rest_client)
    {
        $this->rest_client = $rest_client;
    }

    public function getMediaInfo($access_token, $media_id)
    {
        $uri = self::MEDIA_URI.$media_id;
        $query = ['access_token' => $access_token];

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
            $location = new Utils\GeoPoint(
                $decoded_response['data']['location']['latitude'],
                $decoded_response['data']['location']['longitude']);
        } else {
            $location = NULL;
        }

        $media_info = new Domain\MediaInfo($id, $type, $location);

        return $media_info;
    }
}
