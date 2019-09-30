<?php

//Start Session
session_start();

// Autoload with Composer
require_once __DIR__ . '/../vendor/autoload.php';

$errorHandler = \App\ErrorHandler::getInstance();

$controller = new \App\Controller;
