<?php
/**
 * Yii2 extension to the Twitter API
 *
 * @copyright Copyright &copy; Roman Bahatyi, richweber.net, 2015
 * @package yii2-twitter
 * @version 1.0.1
 */

namespace richweber\twitter;

class OAuthConsumer
{
    public $key;
    public $secret;

    function __construct($key, $secret, $callback_url = NULL)
    {
        $this->key = $key;
        $this->secret = $secret;
        $this->callback_url = $callback_url;
    }

    function __toString()
    {
        return "OAuthConsumer[key=$this->key,secret=$this->secret]";
    }
}