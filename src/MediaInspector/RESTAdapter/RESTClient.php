<?php

namespace MediaInspector\RESTAdapter;

use GuzzleHttp\Client;
use GuzzleHttp\Exception as GuzzleException;
use MediaInspector\Exception as MediaInspectorException;

class RESTClient implements iRESTful 
{
    private $client;
    private $timeout;

    function __construct($base_uri, $timeout = 3.0)
    {
        $this->client = new Client([
            'base_uri' => $base_uri,
            'timeout' => $timeout,
        ]);
        $this->timeout = $timeout;
    }

    public function post($uri, $headers = NULL, $body = NULL, $timeout = NULL)
    {
        throw new \Exception('Not implemented');
    }

    public function get($uri, $query = NULL, $headers = NULL, $timeout = NULL)
    {
        $response = $this->request('GET', $uri, $query, $headers, NULL, $timeout);
        $body = $response->getBody();

        return $body;
    }

    public function put($uri, $query = NULL, $headers = NULL, $body = NULL, $timeout = NULL)
    {
        throw new \Exception('Not implemented');
    }

    public function delete($uri, $query = NULL, $headers = NULL, $timeout = NULL)
    {
        throw new \Exception('Not implemented');
    }

    private function request($method, $uri = NULL, $query = NULL, $headers = NULL, $body = NULL, $timeout = NULL)
    {
        $options = [
            'connect_timeout' => 5.0,
        ];

        if (!is_null($query)) {
            $options['query'] = $query;
        }
 
        if (!is_null($headers)) {
            $options['headers'] = $headers;
        }

        if (!is_null($body)) {
            $options['body'] = $headers;
        }

        $current_timeout = $this->timeout;
        if (!is_null($timeout)) {
            $current_timeout = $timeout;
        }

        try {
            $response = $this->client->request($method, $uri, $options);
        } catch (GuzzleException\ClientException $ex) {
            $request = $ex->getRequest();
            $response = $ex->getResponse();

            throw new MediaInspectorException\ClientException(
                $response->getBody(), $response->getStatusCode(), $ex);
        } catch (GuzzleException\ServerException $ex) {
            $request = $ex->getRequest();
            $response = $ex->getResponse();

            throw new MediaInspectorException\ServerException(
                $response->getBody(), $response->getStatusCode(), $ex);
        }

        return $response;
    }
}
