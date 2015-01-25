<?php
/**
 * @author Mateusz Lisik <matt@procreative.eu>
 */

namespace Matt\HipChatCurrencyNotifier\Notification;


class Notification
{
    const NOTIFICATION_URL = 'hipchat.com/v2/room/%s/notification?auth_token=%s';
    private $token;
    private $curl;

    public function __construct($token)
    {
        $this->token = $token;
        $this->curl = new \Curl();
        $this->curl->setHeader('content-type', 'application/json');
    }

    public function sendMessage($room, $color, $text, $notify)
    {
        $url = sprintf(self::NOTIFICATION_URL, $room, $this->token);
        $this->curl->post($url, json_encode([
            'color' => $color,
            'message' => $text,
            'notify' => (bool)$notify ? 'true' : 'false'
        ]));
    }
}