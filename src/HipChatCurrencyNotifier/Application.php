<?php

namespace Matt\HipChatCurrencyNotifier;

use Matt\HipChatCurrencyNotifier\Config\Config;
use Matt\HipChatCurrencyNotifier\CurrencyChecker\CurrencyChecker;
use Matt\HipChatCurrencyNotifier\Notification\Notification;


class Application
{
    private $config;
    private $currencyChecker;
    private $notifier;
    private $room;
    private $color;
    private $notify;

    public function __construct()
    {
        $this->config = new Config();
        $this->currencyChecker = new CurrencyChecker(
            $this->config->getValue("currency", "from"),
            $this->config->getValue("currency", "to"),
            $this->config->getValue('currency', "apikey")
        );

        $this->notifier = new Notification($this->config->getValue("hipchat", "token"));
        $this->room = $this->config->getValue('hipchat', 'room');
        $this->color = strtolower($this->config->getValue('hipchat', 'color'));
        $this->notify = $this->config->getValue("hipchat", 'notify');
    }

    public function run()
    {
        $currencyRate = $this->currencyChecker->getRate();
        $message = sprintf($this->config->getValue("main", "message"), $currencyRate);
        $this->notifier->sendMessage($this->room, $this->color, $message, $this->notify);
    }
}