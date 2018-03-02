<?php

namespace Core\Helpers;

class AutoLoader
{
    /**
     * Files to require
     * @var array
     */
    public $files = [];

    /**
     * Register autoloader
     * @return self
     */
    public function __construct ()
    {
        spl_autoload_register([$this, '__autoload']);
    }

    /**
     * Add all files from folder to required files
     * @param string folder
     * @return self
     */
    public function addFolder ($folder)
    {
        $files = \scandir($folder);
        $files = array_slice($files, 2);
        foreach ($files as $file)
        {
            $this->files[] = $folder . '/' . $file;
        }

        return $this;
    }

    /**
     * Add file to required files
     * @param string file
     * @return self
     */
    public function addFile ($file)
    {
        $this->files[] = $file;
        return $this;
    }

    /**
     * Autoload class
     * @param string class
     * @return void
     */
    private function __autoload ($class)
    {
        if(file_exists($class))
        {
            require_once $class;
        }

    }

    /**
     * Start autoload
     * @return void
     */
    public function autoLoad ()
    {
        foreach ($this->files as $file)
        {
            $this->__autoload($file);
        }
    }
}