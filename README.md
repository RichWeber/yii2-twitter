# Yii2 extension to the Twitter API

Twitter Oauth Library

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
$ php composer.phar require richweber/yii2-twitter "dev-master"
```

or add

```
"richweber/yii2-twitter": "dev-master"
```

to the ```require``` section of your `composer.json` file.

## Usage

### Component Configuration

```php
'components' => [
    ...
    'twitter' => [
        'class' => 'richweber\twitter\Twitter',
        'consumer_key' => 'YOUR_TWITTER_CONSUMER_KEY',
        'consumer_secret' => 'YOUR_TWITTER_CONSUMER_SECRET',
        'callback' => 'YOUR_TWITTER_CALLBACK_URL',
    ],
    ...
],
```

### License

**yii2-twitter** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.