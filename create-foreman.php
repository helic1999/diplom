<?php
require_once('classes/Foreman.php');
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(404);
    exit;
}

$needParams = ['first_name' => 'имя', 'last_name' => 'фамилия', 'middle_name' => 'отчество', 'login' => 'login', 'password'=> 'пароль'];
$params = [];
foreach ($needParams as $param => $name) {
    if (!isset($_POST[$param]) || !mb_strlen(trim($_POST[$param]))) {
        $_SESSION['create_foreman'][] = 'необходимо заполнить поле ' . $name;
    }
    $params[$param] = $_POST[$param];
}

if (isset($_SESSION['create_foreman'])) {
    header("Location: /admin-page.php");
    exit;
}

var_dump(Foreman::create($params));