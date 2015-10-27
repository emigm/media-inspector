<?php

namespace MediaInspector\UnitTests;

use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use MediaInspector\Domain;
use MediaInspector\Instagram;

class MediaEndPointTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMediaWithLocation() {
        $rest_client_stub = $this->getMockBuilder('\MediaInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $mock_response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $stream = Psr7\stream_for(
                fopen(__DIR__.'/mocks/media_endpoint_with_location_200_OK.txt', 'r')));

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue($mock_response));

        $ACCESS_TOKEN = 'access.token.123';
        $media_endpoint = new Instagram\MediaEndPoint($ACCESS_TOKEN, $rest_client_stub);

        $MEDIA_ID = '1081347983064313090';
        $media = $media_endpoint->getMedia($MEDIA_ID);

        $expected_geo_point = new Domain\GeoPoint('40.7155418', '-73.9533691');
        $expected_media = new Instagram\Media(
            '1081347983064313090_1220832186', 'image', $expected_geo_point);

        $this->assertEquals($expected_media, $media);
    }

    public function testGetMediaWithoutLocation() {
        $rest_client_stub = $this->getMockBuilder('\MediaInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $mock_response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $stream = Psr7\stream_for(
                fopen(__DIR__.'/mocks/media_endpoint_without_location_200_OK.txt', 'r')));

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue($mock_response));

        $ACCESS_TOKEN = 'access.token.123';
        $media_endpoint = new Instagram\MediaEndPoint($ACCESS_TOKEN, $rest_client_stub);

        $MEDIA_ID = '420077066';
        $media = $media_endpoint->getMedia($MEDIA_ID);

        $expected_geo_point = new Domain\GeoPoint(NULL, NULL);
        $expected_media = new Instagram\Media(
            '420077066_4190444', 'image', $expected_geo_point);

        $this->assertEquals($expected_media, $media);
    }
}
