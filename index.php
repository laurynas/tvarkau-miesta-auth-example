<? require 'init.php'; ?>
<html>
<body>

    User:
    <? if ($accessToken->getValues()['scope'] == 'user'): ?>
        <?= $api->getCurrentUser()->id ?>
        / <a href="logout.php">Logout</a>
    <? else: ?>
        Anonymous
        / <a href="login.php">Login</a>
    <? endif ?>

</body>
</html>
