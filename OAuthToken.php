<?php
/**
 * Yii2 extension to the Twitter API
 *
 * @copyright Copyright &copy; Roman Bahatyi, richweber.net, 2015
 * @package yii2-twitter
 * @version 1.0.1
 */

namespace richweber\twitter;

class OAuthToken
{
    public $key;
    public $secret;

    /**
     * key = the token
     * secret = the token secret
     */
    function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * generates the basic string serialization of a token that a server
     * would respond to request_token and access_token calls with
     */
    function to_string()
    {
        return "oauth_token=" .
            OAuthUtil::urlencode_rfc3986($this->key) .
            "&oauth_token_secret=" .
            OAuthUtil::urlencode_rfc3986($this->secret);
    }

    function __toString()
    {
        return $this->to_string();
    }
}