<?php

require_once __DIR__.'/bootstrap.php';

$app->get('/', 'App\Controller\AppController::welcomeAction')->bind('home');