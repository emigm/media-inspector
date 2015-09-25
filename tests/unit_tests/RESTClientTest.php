<?php

namespace MediaInspector\UnitTests;

use MediaInspector\RESTAdapter;

class RESTClientTest extends \PHPUnit_Framework_TestCase
{
    const ACCESS_TOKEN = '37946071.de0b35a.4ad6041a05454637ad4f04f80f530841';

    /**
     * @expectedException           Exception 
     * @expectedExceptionMessage    Not implemented
     */
    public function testPost()
    {
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => self::ACCESS_TOKEN];

        $response = $client->post($URI, $QUERY);
    }

    public function testGet()
    {
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => self::ACCESS_TOKEN];
        $HEADERS = ['Accept' => 'application/json'];
        $TIMEOUT = 3.0;

        $RESPONSE = "{\"meta\":{\"code\":200},\"data\":{\"latitude\":40.714139679,\"id\":\"614396723\",\"longitude\":-73.961486234,\"name\":\"Rosamunde Sausage Grill - Brooklyn\"}}";

        $response = $client->get($URI, $QUERY, $HEADERS, $TIMEOUT);

        $this->assertEquals($RESPONSE, (string) $response);
    }

    /**
     * @expectedException           MediaInspector\Exception\ClientException
     * @expectedExceptionMessage    NOT FOUND
     */
    public function testGetClientError()
    {
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $INVALID_URI = '/v1/invalid/614396723';
        $QUERY = ['access_token' => self::ACCESS_TOKEN];
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
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => self::ACCESS_TOKEN];

        $response = $client->put($URI, $QUERY);
    }

    /**
     * @expectedException           Exception 
     * @expectedExceptionMessage    Not implemented
     */
    public function testDelete()
    {
        $client = new RESTAdapter\RESTClient('https://api.instagram.com');

        $URI = '/v1/locations/614396723';
        $QUERY = ['access_token' => self::ACCESS_TOKEN];

        $response = $client->delete($URI, $QUERY);
    }
}
