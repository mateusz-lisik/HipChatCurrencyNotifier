<?php

namespace Matt\HipChatCurrencyNotifier\CurrencyChecker;


class CurrencyChecker
{
    private $from;
    private $to;
    private $curl;

    public function __construct($from, $to)
    {
        $this->to = $to;
        $this->from = $from;
        $this->curl = new \Curl();
    }

    private function queryRateExchange()
    {
        $this->curl->get("http://rate-exchange.appspot.com/currency", [
            'from' => $this->from,
            'to' => $this->to
        ]);
        return $this->curl->response->rate;
    }

    public function getRate()
    {
        return $this->queryRateExchange();
    }

}