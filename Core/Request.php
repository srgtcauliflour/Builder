<?php

namespace Core;

use Core\Helpers\Helper;

class Request
{
    public $method;
    public $uri;
    public $headers;
    public $params;
    public $body;
    public $query;

    public function __construct()
    {
        $this->body = file_get_contents('php://input');
        $this->query = Helper::arrayToObject($_GET);
    }

    public function getJSONRequest()
    {
        return json_decode($this->body);
    }

    public function getXMLRequest()
    {
        return simplexml_load_string($this->body);
    }
}
