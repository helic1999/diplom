<?php
require_once('../classes/TelegramSender.php');
echo "111";
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit();
}

session_start();
if (!isset($_POST['people'])) {
    $_SESSION['send_error'][] = 'необходимо выбрать получателей';
}

if (!mb_strlen(trim($_POST['message']))) {
    $_SESSION['send_error'][] = 'необходимо вввести сообщение';
}

if (isset($_SESSION['send_error'])) {
    header('Location: /send-form/');
}


$message = trim($_POST['message']);
$people = array_keys($_POST['people']);

$sent = true;
foreach ($people as $person) {
    $res = TelegramSender::send($message, $person);
    if (!$res) {
        $_SESSION['send_error'][] = 'не удалось отправить сообщение';
        header('Location: /send-form/');
        exit();
    }
}
$_SESSION['send_error'][] = 'сообщение успешно отправлено';
header('Location: /send-form/');
exit();


