<?php

namespace Core;

class Console
{
    public $raw;
    public $file;
    public $method;
    public $options;

    public function __construct($arguments)
    {
        $this->raw = $arguments;
        $this->options = [];
        $this->format();
    }

    public function format()
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

        $this->options = \Core\Helpers\Helper::arrayToObject($this->options);
    }

}
