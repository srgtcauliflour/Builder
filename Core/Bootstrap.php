<?php

define('ROOT', __DIR__ . '/..');
define('CORE', ROOT . '/Core');
define('APP', ROOT . '/App');
define('CONFIG', ROOT . '/Config');
define('Migrations', ROOT . '/Migrations');
define('PUBLIC', ROOT . '/public');

require CORE . '/Helpers/Helper.php';
require ROOT . '/vendor/autoload.php';
require CORE . '/Helpers/Autoloader.php';

use Core\Helpers\Autoloader;
use Core\Secret;
use Core\Connection;

$autoloader = new Autoloader();
$autoloader->addFile(CORE . '/Secret.php');
$autoloader->addFile(CORE . '/Connection.php');
$autoloader->autoload();

Secret::setup();
Connection::setup();
