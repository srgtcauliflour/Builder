<?php

namespace Core;

class Response
{
    public $headers;
    public $body;
    public $cookies;
    public $code;

    public function __construct()
    {
        $this->headers = [];
        $this->body = '';
        $this->cookies = [];
    }

    public function json($json)
    {
        $this->body = json_encode($json);
        $this->headers['Content-type'] = 'application/json';
    }

    public function xml($xml)
    {
        $this->body = $xml;
        $this->headers['Content-type'] = 'application/xml';
    }

    public function code($code)
    {
        $this->code = $code;
    }

    public function setCookie($key, $value)
    {
        $this->cookies[$key] = $value;
        return $this;
    }

    public function view($path)
    {
        $this->body = file_get_contents($path);
        $this->headers['Content-type'] = 'text/html';
        return $this;
    }
    
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
