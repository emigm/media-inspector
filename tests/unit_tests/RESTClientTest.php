<?php

namespace MediaInspector\UnitTests;

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
        $access_token = getenv('TEST_INSTAGRAM_ACCESS_TOKEN');
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => $access_token];
        $HEADERS = ['Accept' => 'application/json'];
        $TIMEOUT = 3.0;

        $RESPONSE = "{\"meta\":{\"code\":200},\"data\":{\"latitude\":40.714139679,\"id\":\"614396723\",\"longitude\":-73.961486234,\"name\":\"Rosamunde Sausage Grill - Brooklyn\"}}";

        $response = $client->get($URI, $QUERY, $HEADERS, $TIMEOUT);

        $this->assertEquals($RESPONSE, (string) $response);
    }

    /**
     * @expectedException MediaInspector\Exception\ClientException
     */
    public function testGetClientError()
    {
        $access_token = getenv('TEST_INSTAGRAM_ACCESS_TOKEN');
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $INVALID_URI = '/v1/invalid/614396723';
        $QUERY = ['access_token' => $access_token];
        $HEADERS = ['Accept' => 'application/json'];
        $TIMEOUT = 3.0;

        $response = $client->get($INVALID_URI, $QUERY);
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
