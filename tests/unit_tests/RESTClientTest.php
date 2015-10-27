<?php

namespace MediaInspector\UnitTests;

use GuzzleHttp\EntityBody;
use GuzzleHttp\Exception as GuzzleException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use MediaInspector\RESTAdapter;

class RESTClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException           Exception 
     * @expectedExceptionMessage    Not implemented
     */
    public function testPost()
    {
        $access_token = getenv('TEST_INSTAGRAM_ACCESS_TOKEN');
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => $access_token];

        $response = $client->post($URI, $QUERY);
    }

    public function testGet()
    {
        $MOCK_RESPONSE = new Response(
            200,
            ['Content-Type' => 'application/json; charset=UTF-8'],
            $stream = Psr7\stream_for(
                fopen(__DIR__.'/mocks/rest_client_200_OK.txt', 'r')));

        $client = new RESTAdapter\RESTClient(
            'https://api.instagram.com', new MockHandler([$MOCK_RESPONSE]));

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => $access_token];
        $HEADERS = ['Accept' => 'application/json'];
        $TIMEOUT = 3.0;

        $response_body = $client->get($URI, $QUERY, $HEADERS, $TIMEOUT);

        $this->assertEquals($MOCK_RESPONSE->getStatusCode(), 200);
        $this->assertEquals($MOCK_RESPONSE->getBody(), $response_body->getBody());
    }

    public function testGetClientError()
    {
        $MOCK_RESPONSE = new Response(
            400, 
            ['Content-Type' => 'application/json; charset=UTF-8'],
            Psr7\stream_for(
                fopen(__DIR__.'/mocks/rest_client_bad_request.txt', 'r')));

        $client = new RESTAdapter\RESTClient(
            'https://api.instagram.com', new MockHandler([$MOCK_RESPONSE]));

        $INVALID_URI = '/v1/location/614396723';
        $QUERY = ['access_token' => $access_token];
        $HEADERS = ['Accept' => 'application/json'];

        $response_body = $client->get($INVALID_URI, $QUERY, $HEADERS);

        $this->assertEquals($MOCK_RESPONSE->getStatusCode(), 400);
        $this->assertEquals($MOCK_RESPONSE->getBody(), $response_body->getBody());
    }

    /**
     * @expectedException           Exception 
     * @expectedExceptionMessage    Not implemented
     */
    public function testPut()
    {
        $access_token = getenv('TEST_INSTAGRAM_ACCESS_TOKEN');
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => $access_token];

        $response = $client->put($URI, $QUERY);
    }

    /**
     * @expectedException           Exception 
     * @expectedExceptionMessage    Not implemented
     */
    public function testDelete()
    {
        $access_token = getenv('TEST_INSTAGRAM_ACCESS_TOKEN');
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => $access_token];

        $response = $client->delete($URI, $QUERY);
    }
}
