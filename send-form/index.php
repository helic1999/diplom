<!DOCTYPE HTML>
<html>
<head>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: bisque">
<?php
session_start();
?>
<form method="POST" action="/send-message/">
    <div style="width: 90%; margin: 0 auto">
        <div>
            <h3 class="text-center"> Текст сообщения</h3>
            <?php if (isset($_SESSION['send_error'])):
            foreach ($_SESSION['send_error'] as $error):?>
            <p style="color:red"><?=$error;?></p>
            <?php endforeach;
            endif; ?>

            <textarea name="message" class="form-control" style="width: 100%"></textarea>
            <hr>
        </div>
        <p class="h5">Получатели</p>
        <div class="row">
            <?php for ($i = 0; $i <= 15; $i++): ?>
                <div class="col-3">Иванов Иван Иванович <input type="checkbox" name="people[<?= $i ?>]"></div>
            <?php endfor; ?>
            <div>
                <button class="btn btn-light" style="margin-left: auto; margin-right: auto">Отправить</button>
            </div>

        </div>
    </div>
</body>
</html>
<?php session_destroy(); ?>