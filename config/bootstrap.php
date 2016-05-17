<?php

require_once __DIR__.'/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

$app = new Application();

//Configuration TwigServiceProvider
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates',
));

$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    return $twig;
}));

$app['debug'] = true;