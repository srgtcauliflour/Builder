<?php

namespace Migrations;

use Core\Connection;

class Migration
{
    /**
     * Excluded files
     * @var array
     */
    public $excludes = ['Migration.php', 'Seeds']; 

    /**
     * Possible methods for migrations
     * @var array
     */
    public $possibleMethods = ['up', 'down', 'refresh'];

    /**
     * Method to be executed
     * @param string
     */
    public $method;

    /**
     * Connection
     * @var Core\Connection
     */
    public $connection;

    /**
     * Constructor
     * @param string method to be exeucted
     * @return self
     * @throws Exception
     */
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

    /**
     * Get all migration classes
     * @return array
     */
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

    public function getSeeders()
    {
        $files = \scanDir(MIGRATIONS . DIRECTORY_SEPARATOR . 'Seeders');

        foreach ($files as $key => $file)
        {
            if (strpos($file, '.php') === false)
            {
                unset($files[$key]);
                continue;
            }

            $files[str_replace('.php', '', $file)] = MIGRATIONS . '/Seeders/' . $file;
            unset($files[$key]);
        }

        return $files;
    }

    /**
     * Execute up method
     * @param string class name
     * @return void
     * @throws Exception
     */
    private function up ($className)
    {
        $classPath = "Migrations\\{$className}";

        if (!method_exists("{$classPath}", "up"))
        {
            throw new \Exception("Missing function up in {$className}");
        }

        \call_user_func("{$classPath}::up", $this->connection::schema());
    }

    /**
     * Execute down method
     * @param string class name
     * @return void
     * @throws Exception
     */
    private function down ($className)
    {
        $classPath = "Migrations\\{$className}";

        if (!method_exists("{$classPath}", "down"))
        {
            throw new \Exception("Missing function up in {$className}");
        }

        \call_user_func("{$classPath}::down", $this->connection::schema());
    }

    /**
     * Route through methods
     * @param string class name
     * @return void
     * @throws Exception
     */
    public function route($className)
    {
        
        switch ($this->method) {
            case 'up':
                $this->up($className);
                break;

            case 'down':
                $this->down($className);
                break;

            default:
                throw new \Exception("Method {$this->method} does not exist");
                break;
        }
    }

    /**
     * Execute class
     * @return void
     */
    public function exec()
    {
        if (!LOCAL)
        {
            echo "Cannot execute in staging or production";
            return;
        }

        $migrations = $this->getMigrations();

        if ($this->method == 'refresh')
        {
            echo "Starting refresh method\n";
            $this->method = 'down';
            $reversed = \array_reverse($migrations);
            foreach ($reversed as $name => $path)
            {
                require_once $path;
                $this->route($name);
            }

            $this->method = 'up';
        }

        if ($this->method == 'down')
        {
            echo "Dropping tables\n";
            $migrations = \array_reverse($migrations);
        }

        foreach ($migrations as $name => $path)
        {
            require_once $path;
            $this->route($name);
        }

        if ($this->method == 'up')
        {
            echo "Creating tables\n";
            foreach ($this->getSeeders() as $name => $path)
            {
                require_once $path;

                \call_user_func("\\Migrations\\Seeders\\{$name}::up", \Core\Connection::get());
            }
        }

    }

}
