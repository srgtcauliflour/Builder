<?php

session_start();

/**
 * Define enviroment
 */
if (!isset($_SERVER['SESSIONNAME']) || $_SERVER['SESSIONNAME'] !== "Console")
{
    if (isset($_SERVER['SERVER_ADDR']))
    {
        define('LOCAL', ($_SERVER['SERVER_ADDR'] === '127.0.0.1' ? true : false));
    }
    else
    {
        define('LOCAL', ($_SERVER['SERVER_NAME'] === 'localhost' ? true : false));
    }

    define('STAGING', (strpos($_SERVER['SERVER_NAME'], 'staging') !== false ? true : false));
    define('PRODUCTION', (!LOCAL && !STAGING ? true : false));
}
else
{
    define('LOCAL', true);
    define('STAGING', false);
    define('PRODUCTION', false);
}

$seperator = DIRECTORY_SEPARATOR;

/**
 * Define paths
 */
define("ROOT", __DIR__ . "{$seperator}..");
define("CORE", ROOT . "{$seperator}Core");
define("CACHE", ROOT . "{$seperator}Cache");
define("MIGRATIONS", ROOT . "{$seperator}Migrations");
define("TESTS", ROOT . "{$seperator}Tests");
define("TEST_DATA", TESTS . "{$seperator}TestData");
define("VENDOR", ROOT . "{$seperator}vendor");
define("NODE_MODULES", ROOT . "{$seperator}node_modules");

define("APP", ROOT . "{$seperator}App");
define("CONTROLLERS", APP . "{$seperator}Controllers");
define("MODELS", APP . "{$seperator}Models");
define("MIDDLEWARES", APP . "{$seperator}Middlewares");
define("SERVICES", APP . "{$seperator}Services");

define("FRONT_END", APP . "{$seperator}public");

/**
 * Require main files
 */
require ROOT . '/vendor/autoload.php';
require CORE . '/Helper.php';
require CORE . '/Autoloader.php';

use Core\Helper;
use Core\Autoloader;
use Core\Secret;
use Core\Connection;
use Core\Cache;

/**
 * Setup autoloader
 */
$autoloader = new Autoloader();
$autoloader->addFile(CORE . '/Secret.php');
$autoloader->addFile(CORE . '/Cache.php');
$autoloader->addFile(CORE . '/Connection.php');

$autoloader->addFile(CORE . '/Response.php');
$autoloader->addFile(CORE . '/Request.php');
$autoloader->addFile(CORE . '/Router.php');
$autoloader->addFile(CORE . '/Middleware.php');

$autoloader->addFile(CORE . '/Console.php');
$autoloader->addFile(MIGRATIONS . '/Migration.php');

$autoloader->addFolder(APP . '/Services');
$autoloader->addFolder(APP . '/Middleware');
$autoloader->addFolder(APP . '/Models');
$autoloader->addFolder(APP . '/Controllers');

$autoloader->autoload();

/**
 * Setup core
 */
Secret::setup();
Connection::setup();

Connection::ping();