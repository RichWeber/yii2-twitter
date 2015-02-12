<?php
/**
 * Yii2 extension to the Twitter API
 *
 * @copyright Copyright &copy; Roman Bahatyi, richweber.net, 2015
 * @package yii2-twitter
 * @version 1.0.1
 */

namespace richweber\twitter;

class Twitter
{
    /**
     * The Twitter Apps key, set in config
     * @var string
     */
    public $consumer_key = '';

    /**
     * The Twitter Apps secret key, set in config
     * @var string
     */
    public $consumer_secret = '';

    /**
     * The call back url for twitter
     * @var string
     */
    public $callback = '';

    /**
     * Returns the callback url set in config
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Use this one for when we need to authicate oursevles with twitter
     */
    public function getTwitter()
    {
        return new TwitterOAuth($this->consumer_key, $this->consumer_secret);
    }

    /**
     * Use this for after we have a token and a secret for the use.
     *    (you must save these in order for them to be usefull
     */
    public function getTwitterTokened($token,$secret)
    {
        return new TwitterOAuth($this->consumer_key, $this->consumer_secret, $token,$secret);
    }
}
