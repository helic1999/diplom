<!DOCTYPE HTML>
<html>
<head>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <title>Вход</title>
</head>
<?php
ini_set('display_errors', 1);

require_once('classes/Auth.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Auth::login();
}

?>
<body style="background-color: bisque">
<form class="form-control w-25" style="margin: 0 auto" method="post">

    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST'):
        if (!Auth::isLogged()): ?>
            <p> неверный логин или пароль</p>
        <?php else:
            header('Location: /send-form.php');
        exit;
            ?>

        <?php endif ?>
    <?php elseif (Auth::isLogged()): ?>
        <p>вы уже в системе</p>
    <?php endif ?>
    <label>Логин</label>
    <input type="text" class="form-control" name="login">
    <label>Пароль</label>
    <input type="password" class="form-control" name="password">
    <button class="btn btn-dark">Вход</button>
</form>
</body>
</html>
