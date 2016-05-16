<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

$app = new Application();

$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    return $twig;
}));

$app['debug'] = true;