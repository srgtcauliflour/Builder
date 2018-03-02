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

    public function exec($handler, $request)
    {
        if (!isset($this->collection[$handler]))
        {
            return;
        }


        foreach ($this->collection[$handler] as $key => $callback)
        {
            $callback($request);
        }
    }

}
