<?php

namespace Matt\HipChatCurrencyNotifier\CurrencyChecker;


class CurrencyChecker
{
    private $from;
    private $to;
    private $curl;
    private $apiKey;

    public function __construct($from, $to, $apiKey)
    {
        $this->to = $to;
        $this->from = $from;
        $this->apiKey = $apiKey;
        $this->curl = new \Curl();
    }

    public function getRate()
    {
        return $this->queryRateExchange();
    }

    private function queryRateExchange()
    {
        $this->curl->get("http://openexchangerates.org/api/latest.json", [
            'base' => $this->from,
            'app_id' => $this->apiKey
        ]);
        /** @noinspection PhpUndefinedFieldInspection */
        $rates = (array) $this->curl->response->rates;
        return $rates[$this->to];
    }

}