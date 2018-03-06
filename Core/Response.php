<?php

namespace Core;

use Core\View;

class Response
{
    /**
     * Response headers
     * @var array
     */
    public $headers;

    /**
     * Response body
     * @var string
     */
    public $body;

    /**
     * Response cookies
     * @var array
     */
    public $cookies;

    /**
     * Response code
     * @var int
     */
    public $code;

    /**
     * Constructor
     * @return self
     */
    public function __construct()
    {
        $this->headers = [];
        $this->body = '';
        $this->cookies = [];
    }

    /**
     * Set response body json
     * @param array json
     * @return self
     */
    public function json($json)
    {
        $this->body = json_encode($json);
        $this->headers['Content-type'] = 'application/json';
        return $this;
    }

    /**
     * Set response body xml
     * @param string
     * @return self
     */
    public function xml($xml)
    {
        $this->body = $xml;
        $this->headers['Content-type'] = 'application/xml';
        return $this;
    }

    /**
     * Set response code
     * @param int
     * @return self
     */
    public function code($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Set response cookie
     * @param string key
     * @param string value
     * @return self
     */
    public function setCookie($key, $value)
    {
        $this->cookies[$key] = $value;
        return $this;
    }

    /**
     * Send view response
     * @param string view path
     * @return self
     */
    public function view($path, $template = null)
    {
        $this->body = View::serve($path, $template);
        $this->headers['Content-type'] = 'text/html';
        $this->send(200);
    }
    
    /**
     * Send response
     * @param int response code
     * @return void
     */
    public function send($code = 200)
    {

        if (!is_numeric($this->code))
        {
            $this->code = $code;
        }

        foreach ($this->headers as $key => $value)
        {
            header("{$key}: {$value}");
        }

        foreach ($this->cookies as $key => $value)
        {
            setcookie($key, $value);
        }

        \http_response_code($this->code);

        echo $this->body;
        die;
    }

}
