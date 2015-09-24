<?php

namespace PhotoInspector\RESTAdapter;

interface iRESTful 
{
    public function post($path, $headers = NULL, $body = NULL, $timeout = NULL);

    public function get($path, $query = NULL, $headers = NULL, $timeout = NULL);

    public function put($path, $query = NULL, $headers = NULL, $body = NULL, $timeout = NULL);

    public function delete($path, $query = NULL, $headers = NULL, $timeout = NULL);
}
