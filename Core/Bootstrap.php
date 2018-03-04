<?php

session_start();

if (!isset($isConsole))
{
    $isConsole = false;
}

/**
 * Define enviroment
 */
if (!$isConsole)
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

/**
 * Define paths
 */
define('ROOT', __DIR__ . '/..');
define('CORE', ROOT . '/Core');
define('CACHE', ROOT . '/Cache');
define('MIGRATIONS', ROOT . '/Migrations');

define('APP', ROOT . '/App');
define('CONTROLLERS', APP . '/Controllers');
define('MODELS', APP . '/Models');
define('MIDDLEWARES', APP . '/Middlewares');
define('SERVICES', APP . '/Services');

define('FRONT_END', APP . '/public');

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

/**
 * Setup autoloader
 */
$autoloader = new Autoloader();
$autoloader->addFile(CORE . '/Secret.php');
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
