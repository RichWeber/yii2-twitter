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

### Authenticate application

```php
<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function actionIndex()
    {
        $twitter = Yii::$app->twitter->getTwitter();
        $request_token = $twitter->getRequestToken();
 
        //set some session info
        Yii::$app->session['oauth_token'] = $token = $request_token['oauth_token'];
        Yii::$app->session['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
        if ($twitter->http_code == 200){
            //get twitter connect url
            $url = $twitter->getAuthorizeURL($token);
            //send them
            return $this->redirect($url);
        } else {
            //error here
            return $this->redirect(Url::home());
        }
    }
}
?>
```

### Callback action

```php
<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function actionTwitterCallBack()
    {
        /* If the oauth_token is old redirect to the connect page. */
        if (isset($_REQUEST['oauth_token']) && Yii::$app->session['oauth_token'] !== $_REQUEST['oauth_token']) {
            Yii::$app->session['oauth_status'] = 'oldtoken';
        }
 
        /* Create TwitteroAuth object with app key/secret and token key/secret from default phase */
        $twitter = Yii::$app->twitter->getTwitterTokened(Yii::$app->session['oauth_token'], Yii::$app->session['oauth_token_secret']);   
 
        /* Request access tokens from twitter */
        $access_token = $twitter->getAccessToken($_REQUEST['oauth_verifier']);
 
        /* Save the access tokens. Normally these would be saved in a database for future use. */
        Yii::$app->session['access_token'] = $access_token;
 
        /* Remove no longer needed request tokens */
        unset(Yii::$app->session['oauth_token']);
        unset(Yii::$app->session['oauth_token_secret']);
 
        if (200 == $twitter->http_code) {
            /* The user has been verified and the access tokens can be saved for future use */
            Yii::$app->session['status'] = 'verified';
 
            //get an access twitter object
            $twitter = Yii::$app->twitter->getTwitterTokened($access_token['oauth_token'],$access_token['oauth_token_secret']);
 
            //get user details
            $twuser= $twitter->get("account/verify_credentials");
            //get friends ids
            $friends= $twitter->get("friends/ids");
            //get followers ids
            $followers= $twitter->get("followers/ids");
            //tweet
            $result=$twitter->post('statuses/update', ['status' => "Tweet message"]);
 
        } else {
            /* Save HTTP status for error dialog on connnect page.*/
            //header('Location: /clearsessions.php');
            return $this->redirect(Url::home());
        }
    }
}
?>
```

### License

**yii2-twitter** is released under the BSD 3-Clause License. See the bundled `LICENSE.md` for details.