<? require 'init.php'; ?>
<html>
<body>

    User:

    <? $user = $api->getCurrentUser(); ?>

    <? if ($user->guest): ?>
        Anonymous
        / <a href="login.php">Login</a>
    <? else: ?>
        <?= $user->email ?: $user->name ?>
        / <a href="logout.php">Logout</a>
    <? endif ?>

</body>
</html>
