<?
require './vendor/autoload.php';
require 'api.php';

// Basic OAuth2 client usage example based on http://oauth2-client.thephpleague.com/usage/
$oauthProvider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'web-dev',
    // 'redirectUri'             => 'https://tvarkaumiesta.lt/auth/callback',
    'redirectUri'             => 'https://localhost:4443/login_callback.php',
    'urlAuthorize'            => 'https://api.tvarkaumiesta.lt/oauth/authorize',
    'urlAccessToken'          => 'https://api.tvarkaumiesta.lt/oauth/token',
    'urlResourceOwnerDetails' => 'https://api.tvarkaumiesta.lt/me'
]);

session_start();

if (empty($_SESSION['access_token']))
    $_SESSION['access_token'] = $oauthProvider->getAccessToken('client_credentials');

$accessToken = $_SESSION['access_token'];

$api = new API($oauthProvider, $accessToken);
