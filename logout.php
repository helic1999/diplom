<?php
ini_set('display_errors', 1);

require_once('classes/Auth.php');
    Auth::logout();
echo "выход успешно выполнен";
