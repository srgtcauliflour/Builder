<?php

namespace Migrations;

use Core\Connection;

class Migration
{
    public $excludes = ['Migration.php']; 
    public $possibleMethods = ['up', 'down', 'refresh'];
    public $method;
    public $connection;

    public function __construct($method)
    {
        $method = strtolower($method);

        if (!in_array($method, $this->possibleMethods))
        {
            throw new \Exception($method . ' is not a possible method');
        }

        $this->connection = Connection::get();
        $this->method = $method;
    }

    public function getMigrations()
    {
        $files = \scanDir(__DIR__);
        
        foreach ($files as $key => $file)
        {
            if (strpos($file, '.php') === false)
            {
                unset($files[$key]);
                continue;
            }

            if (in_array($file, $this->excludes))
            {
                unset($files[$key]);
                continue;
            }

            $files[str_replace('.php', '', $file)] = MIGRATIONS . '/' . $file;
            unset($files[$key]);
        }

        return $files;
    }

    public function route($className)
    {
        $classPath = "Migrations\\{$className}";
        switch ($this->method) {
            case 'up':
                if (!method_exists("{$classPath}", "up"))
                {
                    throw new \Exception("Missing function up in {$className}");
                }
                \call_user_func("{$classPath}::up", $this->connection);
                break;

            case 'down':
                if (!method_exists("{$classPath}", "down"))
                {
                    throw new \Exception("Missing function down in {$className}");
                }
                \call_user_func("{$classPath}::down", $this->connection);
                break;

            case 'refresh':
                if (!method_exists("{$classPath}", "up"))
                {
                    throw new \Exception("Missing function up in {$className}");
                }

                if (!method_exists("{$classPath}", "down"))
                {
                    throw new \Exception("Missing function down in {$className}");
                }

                \call_user_func("{$classPath}::down", $this->connection);
                \call_user_func("{$classPath}::up", $this->connection);
                break;

            default:
                throw new \Exception("Method {$this->method} does not exist");
                break;
        }
    }

    public function exec()
    {
        $migrations = $this->getMigrations();

        foreach ($migrations as $name => $path)
        {
            require_once $path;
            $this->route($name);
        }
    }

}
