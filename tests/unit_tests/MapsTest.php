<?php

namespace MediaInspector\UnitTests;

use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Response;
use MediaInspector\Google;
use MediaInspector\Utils;

class MapsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetReverseGeoCode() {
        $rest_client_stub = $this->getMockBuilder('\MediaInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $mock_response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $stream = Psr7\stream_for(
                fopen(__DIR__.'/mocks/maps_reverse_geocode_200_OK.txt', 'r')));

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue($mock_response));

        $API_KEY = 'api.key.123';
        $maps = new Google\Maps($API_KEY, $rest_client_stub);

        $GEO_POINT = new Utils\GeoPoint('40.7155418', '-73.9533691');
        $reverse_geo_code = $maps->getReverseGeoCode($GEO_POINT);

        $expected_reverse_geo_code = new Utils\ReverseGeoCode(
            '277 Bedford Ave, Brooklyn, NY 11211, USA', 'Williamsburg',
            'Brooklyn', 'NY', '11211', 'Kings County', 'NY', 'US');

        $this->assertEquals($expected_reverse_geo_code, $reverse_geo_code);
    }

    public function testGetPartialReverseGeoCode() {
        $rest_client_stub = $this->getMockBuilder('\MediaInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $mock_response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $stream = Psr7\stream_for(
                fopen(__DIR__.'/mocks/maps_partial_reverse_geocode_200_OK.txt', 'r')));

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue($mock_response));

        $API_KEY = 'api.key.123';
        $maps = new Google\Maps($API_KEY, $rest_client_stub);

        $GEO_POINT = new Utils\GeoPoint('40.7155418', '-73.9533691');
        $reverse_geo_code = $maps->getReverseGeoCode($GEO_POINT);

        $expected_reverse_geo_code = new Utils\ReverseGeoCode(
            NULL, 'Williamsburg', 'Brooklyn', 'NY', '11211', 'Kings County',
            'NY', 'US');

        $this->assertEquals($expected_reverse_geo_code, $reverse_geo_code);
    }

    public function testGetEmptyReverseGeoCode() {
        $rest_client_stub = $this->getMockBuilder('\MediaInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $mock_response = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $stream = Psr7\stream_for(
                fopen(__DIR__.'/mocks/maps_empty_reverse_geocode_200_OK.txt', 'r')));

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue($mock_response));

        $API_KEY = 'api.key.123';
        $maps = new Google\Maps($API_KEY, $rest_client_stub);

        $GEO_POINT = new Utils\GeoPoint('40.7155418', '-73.9533691');
        $reverse_geo_code = $maps->getReverseGeoCode($GEO_POINT);

        $expected_reverse_geo_code = new Utils\ReverseGeoCode(
            NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

        $this->assertEquals($expected_reverse_geo_code, $reverse_geo_code);
    }
}
