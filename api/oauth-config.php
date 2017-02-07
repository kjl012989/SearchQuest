<?php

require_once(dirname(__FILE__) . '/oauthservice.php');
/// TODO: update redirect_baseuri so it uses the classname automatically

// Define classes that extend OAuthService as shown below.  Utilize the 'OAuthService_' prefix for class names.

// Asana OAuth 2.0 example

class OAuthService_Asana extends OAuthService {
    public $consumerkey = 'SMmObNG1WLr3h1tYCrV4n5gxC';
    public $consumersecret = 'eV8FMcCJnaUJNzjgAB7qIDrCDUWw9pD1zvFaJx8W48mHKrh3nj';
    public $apibaseurl = 'https://app.asana.com/api/1.0';
    public $tokenurl = 'https://app.asana.com/-/oauth_token';
    public $authorizeurl = 'https://app.asana.com/-/oauth_authorize';
    public $redirect_baseuri = 'https://asanaprojecttools-c9-ajmudrak.c9.io/api/oauth-callback.php/Asana';
    public $response_type = 'code';
    public $grant_type = 'authorization_code'; // authorization_code, password
    public $app_url = '/';
}

// Twitter example: using app-only authorization

class OAuthService_TwitterAppOnly extends OAuthService {
    public $consumerkey = 'SMmObNG1WLr3h1tYCrV4n5gxC';
    public $consumersecret = 'eV8FMcCJnaUJNzjgAB7qIDrCDUWw9pD1zvFaJx8W48mHKrh3nj';
    public $apibaseurl = 'https://api.twitter.com/1.1';
    public $tokenurl = 'https://api.twitter.com/oauth2/token';

    public $oauth_version = 2;
    public $grant_type = 'client_credentials';
}

// Twitter example: using user context authorization

class OAuthService_Twitter extends OAuthService {
    public $oauth_version = 1;
    public $signature_method = 'HMAC-SHA1';
    
    // your oauth app key (or client_id)
    public $consumerkey = 'SMmObNG1WLr3h1tYCrV4n5gxC';
    // your oauth app secret
    public $consumersecret = 'eV8FMcCJnaUJNzjgAB7qIDrCDUWw9pD1zvFaJx8W48mHKrh3nj';
    
    // main URL that the api is based off of
    public $apibaseurl = 'https://api.twitter.com/1.1';
    
    // API's OAuth 1.0 URL for getting a "request token" to redirect the user
    public $requesttokenurl = 'https://api.twitter.com/oauth/request_token';
    // API's OAuth 1.0 URL to redirect the browser to for authorization
    public $authorizeurl = 'https://api.twitter.com/oauth/authorize';
    // The URL on your application that OAuth 1.0 should make a callback to with the token verifier
    public $redirect_baseuri = 'https://asanaprojecttools-c9-ajmudrak.c9.io/api/oauth-callback.php/Twitter';
    // API's OAuth 1.0 URL for getting the "access token" using the callback data
    public $tokenurl = 'https://api.twitter.com/oauth/access_token';

    // where your app lives (redirects here after authorization)
    public $app_url = '/twittertest2.html';
    
}
