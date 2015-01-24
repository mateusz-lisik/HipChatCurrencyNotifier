<?php

namespace Matt\HipChatCurrencyNotifier;

use Matt\HipChatCurrencyNotifier\Notification\Notification;
use Matt\HipChatCurrencyNotifier\Config\Config;
use Matt\HipChatCurrencyNotifier\CurrencyChecker\CurrencyChecker;


class Application
{
    private $config;
    private $currencyChecker;
    private $notifier;

    public function __construct()
    {
        $this->config = new Config();
        $this->currencyChecker = new CurrencyChecker(
            $this->config->getValue("currency", "from"),
            $this->config->getValue("currency", "to")
        );

        $this->notifier = new Notification($this->config->getValue("hipchat", "token"));
    }

    public function run()
    {
        $currencyRate = $this->currencyChecker->getRate();
        $message = sprintf($this->config->getValue("main", "message"), $currencyRate);
        $this->notifier->sendMessage("ProCreative", "yellow", $message);
    }
}