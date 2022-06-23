<?php
require_once('classes/Workers.php');
ini_set('display_errors', 1);
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit;
}

$needParams = ['first_name' => 'имя', 'last_name' => 'фамилия', 'middle_name' => 'отчество', 'telegram_id' => 'id в телеграме'];
$params = [];
foreach ($needParams as $param => $name) {
    if (!isset($_POST[$param]) || !mb_strlen(trim($_POST[$param]))) {
        $_SESSION['create-worker'][] = 'необходимо заполнить поле ' . $name;
    }
    $params[$param] = $_POST[$param];
}



if (isset($_SESSION['create-worker'])) {
    header("Location: /admin-page.php");
    exit;
}

if(Workers::exist($params['telegram_id'])) {
    $_SESSION['create-worker'][] = 'рабочий с таким id телеграма уже существует';
   header("Location: /admin-page.php");
    exit;
}

$_SESSION['create-worker'][] = Workers::create($params) ? 'аккаунт успешно создан' : 'не удалось создать аккаунт';
header("Location: /admin-page.php");
exit;