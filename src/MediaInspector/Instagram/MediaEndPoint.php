<?php

namespace MediaInspector\Instagram;

use GuzzleHttp\Exception as GuzzleException;
use MediaInspector\Domain;
use MediaInspector\Exception;
use MediaInspector\RESTAdapter;
use MediaInspector\Utils;
use MediaInspector\Exception as MediaInspectorException;

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

        switch ($response->getStatusCode()) {
            case 200:
                return $this->responseToMedia($response);
                break;
            case 400:
                $this->responseToClientException($response);
                break;
            case 500:
                $this->responseToServerException($response);
                break;
            default:
                $this->responseToServerException($response);
                break;
        }
    }

    private function responseToMedia($response)
    {
        $decoded_body = json_decode($response->getBody(), true);

        $id = (isset($decoded_body['data']['id'])) ?
            $decoded_body['data']['id'] : NULL;
        $type = (isset($decoded_body['data']['type'])) ?
            $decoded_body['data']['type'] : NULL;

        $latitude = (isset($decoded_body['data']['location'])) ?
            $decoded_body['data']['location']['latitude'] : NULL;
        $longitude = (isset($decoded_body['data']['location'])) ?
            $decoded_body['data']['location']['longitude'] : NULL;
        $geo_point = new Utils\GeoPoint($latitude, $longitude);

        $media = new Media($id, $type, $geo_point);

        return $media;
    }

    private function responseToClientException($response)
    {
        $decoded_body = json_decode($response->getBody(), true);

        switch ($decoded_body['meta']['error_type']) {
            case 'OAuthAccessTokenException':
                throw new Exception\UnauthorizedException(
                    'Invalid access token', $response->getStatusCode());
                break;
            case 'APINotFoundError':
                throw new MediaInspectorException\ClientException(
                    'Media not found', $response->getStatusCode());
                break;
            default:
                throw new MediaInspectorException\ClientException(
                    'Invalid request', $response->getStatusCode());
                break;
        }
    }

    private function responseToServerException($response)
    {
        throw new Exception\ServerException(
            'Something went wrong', $response->getStatusCode());
    }
}
