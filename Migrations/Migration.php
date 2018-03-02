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

    private function up ($className)
    {
        $classPath = "Migrations\\{$className}";
        $table = $classPath::$table;

        if (!method_exists("{$classPath}", "up"))
        {
            throw new \Exception("Missing function up in {$className}");
        }

        if (!$this->connection::schema()->hasTable($table))
        {
            \call_user_func("{$classPath}::up", $this->connection::schema());
        }
    }

    private function down ($className)
    {
        $classPath = "Migrations\\{$className}";
        $table = $classPath::$table;

        if (!method_exists("{$classPath}", "down"))
        {
            throw new \Exception("Missing function up in {$className}");
        }

        if ($this->connection::schema()->hasTable($table))
        {
            \call_user_func("{$classPath}::down", $this->connection::schema());
        }
    }

    public function route($className)
    {
        
        switch ($this->method) {
            case 'up':
                $this->up($className);
                break;

            case 'down':
                $this->down($className);
                break;

            case 'refresh':
                $this->down($className);
                $this->up($className);
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
