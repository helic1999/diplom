<?php
ini_set('display_errors', 1);
require_once('classes/Auth.php');
require_once('classes/Users.php');
require_once('classes/Workers.php');
Auth::redirectUnauthorised();
if (!isset($_SESSION)) {
    session_start();
}


?>
    <!DOCTYPE HTML>
    <html>
    <head>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="background-color: bisque">
    <?php
    if (!Users::isAdmin($_SESSION['admin']['login'])) {
        echo 'у вас нет доступа к этой странице';
    }
    $workers = Workers::getAll();

    ?>
    <form method="POST" action="/create-foreman.php">
        <div style="width: 90%; margin: 0 auto">
            <div>
                <h3 class="text-center"> Создание аккаунта прораба</h3>
                <?php if (isset($_SESSION['create-foreman'])):
                    foreach ($_SESSION['create-foreman'] as $error):?>
                        <div class="alert alert-info"><?= $error; ?></div>
                    <?php endforeach;
                endif; ?>
                <label>Фамилия</label>
                <input type="text" class="form-control" name="last_name">
                <label>Имя</label>
                <input type="text" class="form-control" name="first_name">
                <label>Отчество</label>
                <input type="text" class="form-control" name="middle_name">
                <label>Логин</label>
                <input type="text" class="form-control" name="login">
                <label>Пароль</label>
                <input type="text" class="form-control" name="password">
                <hr>
            </div>

            <button class="btn btn-light" style="margin-left: auto; margin-right: auto">Создать</button>
        </div>

    </form>
    <form method="POST" action="/create-worker.php">
        <div style="width: 90%; margin: 0 auto">
            <div>
                <h3 class="text-center"> Создание аккаунта рабочего</h3>
                <?php
                if (isset($_SESSION['create-worker'])):
                    foreach ($_SESSION['create-worker'] as $error):?>
                        <div class="alert alert-info"><?= $error; ?></div>
                    <?php endforeach;
                endif; ?>
                <label>Фамилия</label>
                <input type="text" class="form-control" name="last_name">
                <label>Имя</label>
                <input type="text" class="form-control" name="first_name">
                <label>Отчество</label>
                <input type="text" class="form-control" name="middle_name">
                <label>id в телеграме</label>
                <input type="text" class="form-control" name="telegram_id">
                <hr>
            </div>

            <button class="btn btn-light" style="margin-left: auto; margin-right: auto">Создать</button>
        </div>

    </form>
    </body>
    </html>
<?php
unset($_SESSION['create-foreman']);
unset($_SESSION['create-worker']);
?>