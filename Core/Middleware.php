<?php

namespace Core;

class Middleware
{

    public $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function add($handler, $callback)
    {
        $this->collection[$handler][] = $callback;
        return $this;
    }

    public function exec($handler, $request, $response)
    {
        if (!isset($this->collection[$handler]))
        {
            return;
        }


        foreach ($this->collection[$handler] as $key => $callback)
        {
            $raw = $callback;
            if (is_callable($callback))
            {
                $callback($request, $response);
            }
            else
            {
                $callback = explode('.', $callback);
                call_user_func("Middleware\\{$callback[0]}::{$callback[1]}", $request, $response);
            }
        }
    }

}
