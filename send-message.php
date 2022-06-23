<?php
require_once('classes/TelegramSender.php');
require_once('classes/Users.php');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit();
}

if (!isset($_SESSION)) {
    session_start();
}
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
$user = Users::getByLogin($_SESSION['admin']['login']);
$message .= PHP_EOL . PHP_EOL. ' от: ' . $user['last_name'] . ' ' . $user['first_name'] . ' ' . $user['middle_name'];
$people = array_keys($_POST['people']);
echo "111";
$sent = true;
foreach ($people as $person) {
    $res = TelegramSender::send($message, $person);
    if (!$res) {
        $_SESSION['send_error'][] = 'не удалось отправить сообщение';
        header('Location: /send-form.php');
        exit();
    }
}
$_SESSION['send_error'][] = 'сообщение успешно отправлено';
header('Location: /send-form.php');
exit();


