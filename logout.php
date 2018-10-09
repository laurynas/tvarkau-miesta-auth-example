<?
require 'init.php';

$_SESSION['access_token'] = null;

$api->revokeToken();

header('Location: index.php');
