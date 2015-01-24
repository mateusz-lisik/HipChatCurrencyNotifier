<?php
namespace Matt\HipChatCurrencyNotifier\Config;

class Config
{
    private $configArray;

    public function __construct($filename = "configuration.ini")
    {
        $this->configArray = parse_ini_file($filename, true);
    }

    public function getSection($section)
    {
        return $this->configArray[$section];
    }

    public function getValue($section, $property)
    {
        return $this->configArray[$section][$property];
    }
}