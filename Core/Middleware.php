<?php

namespace Core;

class Middleware
{
    /**
     * Collection of middleware
     * @var array
     */
    public $collection;

    /**
     * Constructor
     * @return self
     */
    public function __construct()
    {
        $this->collection = [];
    }

    /**
     * Add middleware to handle
     * @param string handle
     * @param mixed callback
     * @return self
     */
    public function add($handler, $callback)
    {
        $this->collection[$handler][] = $callback;
        return $this;
    }

    /**
     * Execute middleware
     * @param mixed handle
     * @param Core\Request request
     * @param Core\Response response
     * @return void
     */
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
