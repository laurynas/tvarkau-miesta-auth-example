<?
require 'init.php';

// Fetch the authorization URL from the provider; this returns the
// urlAuthorize option and generates and applies any necessary parameters
// (e.g. state).
$authorizationUrl = $oauthProvider->getAuthorizationUrl([
    'scope' => ['user']
]);

// Get the state generated for you and store it to the session.
$_SESSION['oauth2state'] = $oauthProvider->getState();

// Redirect the user to the authorization URL.
header('Location: ' . $authorizationUrl);
