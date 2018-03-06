<?php

namespace Tests\Benchmarks;

class Benchmark
{

    public $name;

    public $float;

    public $callables;

    public $result;

    public function __construct($name, $float = true)
    {
        $this->name = $name;
        $this->float = $float;
        $this->callables = [];
    }

    public function startTimer()
    {
        return microtime($this->float);
    }

    public function stopTimer()
    {
        return microtime($this->float);
    }

    public function add($name, $callable)
    {
        $this->callables[$name] = $callable;
    }

    public function exec()
    {
        foreach ($this->callables as $name => $callable)
        {
            $start = $this->startTimer();
            $callable();
            $stop = $this->stopTimer();
            $timer = $stop - $start;
            $this->result[$name] = $timer;
        }
    }

    public function print()
    {
        echo implode([
            "====================",
            PHP_EOL,
            "Results for {$this->name}",
            PHP_EOL
        ]);

        foreach ($this->result as $name => $time)
        {
            echo implode([
                "====================",
                PHP_EOL,
                "{$name} => {$time}",
                PHP_EOL
            ]);
        }
    }

}
