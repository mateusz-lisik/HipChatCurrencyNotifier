<?php

require __DIR__ . "\\..\\vendor\\autoload.php";

$autoloader = new \Keradus\Psr4Autoloader();
$autoloader->addNamespace("Matt", __DIR__);
$autoloader->register();

$app = new \Matt\HipChatCurrencyNotifier\Application();
$app->run();
