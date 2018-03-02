<?php

namespace Core;

use Core\Helpers\Helper;

class Request
{
    /**
     * Http method
     * @var string
     */
    public $method;

    /**
     * Request uri
     * @var string
     */
    public $uri;

    /**
     * Request headers
     * @var array
     */
    public $headers;

    /**
     * Parameter variables
     * @var object
     */
    public $params;
    
    /**
     * Request body
     * @var string
     */
    public $body;

    /**
     * GET queries
     * @var array
     */
    public $query;

    /**
     * Constructor
     * @return self
     */
    public function __construct()
    {
        $this->body = file_get_contents('php://input');
        $this->query = Helper::arrayToObject($_GET);
    }

    /**
     * Decode json request body
     * @return object
     */
    public function getJSONRequest()
    {
        return json_decode($this->body);
    }

    /**
     * Decode xml request body
     * @return object
     */
    public function getXMLRequest()
    {
        return simplexml_load_string($this->body);
    }
}
