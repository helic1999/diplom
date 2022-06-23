<?php
require_once('classes/Foreman.php');
ini_set('display_errors', 1);
if (!isset($_SESSION)) {
    session_start();
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit;
}

$needParams = ['first_name' => 'имя', 'last_name' => 'фамилия', 'middle_name' => 'отчество', 'login' => 'login', 'password'=> 'пароль'];
$params = [];
foreach ($needParams as $param => $name) {
    if (!isset($_POST[$param]) || !mb_strlen(trim($_POST[$param]))) {
        $_SESSION['create-foreman'][] = 'необходимо заполнить поле ' . $name;
    }
    $params[$param] = $_POST[$param];
}

if (isset($_SESSION['create-foreman'])) {
    header("Location: /admin-page.php");
    exit;
}

if(Foreman::exist($params['login'])) {
    $_SESSION['create-foreman'][] = 'пользователь с таким логином уже существует';
    header("Location: /admin-page.php");
    exit;
}

$_SESSION['create-foreman'][] = Foreman::create($params) ? 'аккаунт успешно создан' : 'не удалось создать аккаунт';
header("Location: /admin-page.php");
exit;