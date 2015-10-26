<?php

namespace MediaInspector\Google;

use MediaInspector\Domain;
use MediaInspector\Exception;
use MediaInspector\RESTAdapter;
use MediaInspector\Utils;

class Maps implements Domain\iReverseGeoCode
{
    CONST GEOCODE_URI = '/maps/api/geocode/json';

    private $rest_client;

    function __construct($api_key, $rest_client)
    {
        $this->api_key = $api_key;
        $this->rest_client = $rest_client;
    }

    public function getReverseGeoCode(Utils\GeoPoint $geo_point)
    {
        $uri = self::GEOCODE_URI;
        $lat_lng = $geo_point->getLatitude().','.$geo_point->getLongitude();
        $query = ['latlng' => $lat_lng, 'key' => $this->api_key];

        $response = $this->rest_client->get($uri, $query);

        switch ($response->getStatusCode()) {
            case 200:
                return $this->responseToReverseGeoCode($response);
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

        return $reverse_geo_code;
    }

    private function responseToReverseGeoCode($response)
    {
        $street_address = NULL;
        $neighborhood = NULL;
        $sub_locality = NULL;
        $locality = NULL;
        $postal_code = NULL;
        $admin_area_2 = NULL;
        $admin_area_1 = NULL;
        $country = NULL;

        $decoded_body = json_decode($response->getBody(), true);

        foreach ($decoded_body['results'] as $result) {
            $types = $result['types'];

            if(in_array('street_address', $types)) {
                $street_address = $result['formatted_address'];
            } elseif(in_array('neighborhood', $types)) {
                $neighborhood = $result['address_components'][0]['short_name'];
            } elseif(in_array('sublocality', $types)) {
                $sub_locality = $result['address_components'][0]['short_name'];
            } elseif(in_array('locality', $types)) {
                $locality = $result['address_components'][0]['short_name'];
            } elseif(in_array('postal_code', $types)) {
                $postal_code = $result['address_components'][0]['short_name'];
            } elseif(in_array('administrative_area_level_2', $types)) {
                $admin_area_2 = $result['address_components'][0]['short_name'];
            } elseif(in_array('administrative_area_level_1', $types)) {
                $admin_area_1 = $result['address_components'][0]['short_name'];
            } elseif(in_array('country', $types)) {
                $country = $result['address_components'][0]['short_name'];
            }
        }

        $reverse_geo_code = new Utils\ReverseGeoCode(
            $street_address, $neighborhood, $sub_locality, $locality,
            $postal_code, $admin_area_2, $admin_area_1, $country);

        return $reverse_geo_code;
    }

    private function responseToClientException($response)
    {
        throw new Exception\ClientException(
            'Invalid request', $response->getStatusCode());
    }

    private function responseToServerException($response)
    {
        throw new Exception\ServerException(
            'Something went wrong', $response->getStatusCode());
    }
}
