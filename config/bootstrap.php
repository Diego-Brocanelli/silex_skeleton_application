<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

$app = new Application();


$app['db.options'] = [
    'driver'   => 'database_driver',
    'host'     => 'database_host',
    'port'     => 'database_port',
    'dbname'   => 'database_name',
    'user'     => 'database_user',
    'password' => 'database_password'
];

$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    return $twig;
}));

$app['debug'] = true;