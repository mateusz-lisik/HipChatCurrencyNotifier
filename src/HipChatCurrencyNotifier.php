<?php

require __DIR__ . DIRECTORY_SEPARATOR .  ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

$autoloader = new \Keradus\Psr4Autoloader();
$autoloader->addNamespace("Matt", __DIR__);
$autoloader->register();

$app = new \Matt\HipChatCurrencyNotifier\Application();
$app->run();
