<?php
/**
 * Yii2 extension to the Twitter API
 *
 * @copyright Copyright &copy; Roman Bahatyi, richweber.net, 2015
 * @package yii2-twitter
 * @version 1.0.1
 */

namespace richweber\twitter;

class OAuthSignatureMethod_HMAC_SHA1 extends OAuthSignatureMethod
{
    function get_name()
    {
        return "HMAC-SHA1";
    }

    public function build_signature($request, $consumer, $token)
    {
        $base_string = $request->get_signature_base_string();
        $request->base_string = $base_string;
        $key_parts = [
            $consumer->secret,
            ($token) ? $token->secret : ""
        ];
        $key_parts = OAuthUtil::urlencode_rfc3986($key_parts);
        $key = implode('&', $key_parts);
        return base64_encode(hash_hmac('sha1', $base_string, $key, true));
    }
}