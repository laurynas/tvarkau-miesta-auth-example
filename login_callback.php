<?
require 'init.php';

if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}

$_SESSION['access_token'] = $oauthProvider->getAccessToken('authorization_code', [
    'code' => $_GET['code'],
]);

header('Location: index.php');
