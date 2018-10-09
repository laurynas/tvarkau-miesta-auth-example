<?
require './vendor/autoload.php';
require 'api.php';

// Basic OAuth2 client usage example based on http://oauth2-client.thephpleague.com/usage/
$oauthProvider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => 'web-dev',
    'redirectUri'             => 'https://localhost:4443/login_callback.php',
    // for production use following clientId and redirectUri
    //'clientId'                => 'web',
    //'redirectUri'             => 'https://tvarkaumiesta.lt/auth/callback',
    'urlAuthorize'            => 'https://api.tvarkaumiesta.lt/oauth/authorize',
    'urlAccessToken'          => 'https://api.tvarkaumiesta.lt/oauth/token',
    'urlResourceOwnerDetails' => 'https://api.tvarkaumiesta.lt/me'
]);

session_start();

// get access token if does not exist in session yet
if (empty($_SESSION['access_token']))
    $_SESSION['access_token'] = $oauthProvider->getAccessToken('client_credentials');

// read existing token from session
$accessToken = $_SESSION['access_token'];

// check if token has expired and refresh if needed
if ($accessToken->hasExpired()) {
    $refreshToken = $accessToken->getRefreshToken();
    $accessToken = $oauthProvider->getAccessToken('refresh_token', [
        'refresh_token' => $refreshToken
    ]);

    $_SESSION['access_token'] = $accessToken;
}

$api = new API($oauthProvider, $accessToken);
