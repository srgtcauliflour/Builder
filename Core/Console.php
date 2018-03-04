<?php

namespace Core;

class Console
{
    /**
     * Raw arguments
     * @var array
     */
    public $raw;

    /**
     * File name
     * @var string
     */
    public $file;

    /**
     * Method name
     * @var string
     */
    public $method;

    /**
     * Options
     * @var object
     */
    public $options;

    /**
     * Constructor
     * @param array argv
     * @return self
     */
    public function __construct($arguments)
    {
        $this->raw = $arguments;
        $this->options = [];
        $this->setup();
    }

    /**
     * Setup the class instance
     * @return void
     */
    public function setup()
    {
        foreach ($this->raw as $key => $value)
        {
            if ($key === 0)
            {
                $this->file = $value;
                continue;
            }

            if ($key == 1)
            {
                $this->method = $value;
                continue;
            }

            if (strpos($value, '--') !== false)
            {
                $option = str_replace('--', '', $value);
                $optionVal = $this->raw[$key + 1];
                $this->options[$option] = $optionVal;
            }
        }

        $this->options = \Core\Helper::arrayToObject($this->options);
    }

}
