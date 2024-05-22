<?php
include_once 'c_login.php';
include_once 'm_login.php';
include_once '../conexion.php';


$login = new LoginController();
switch ($_REQUEST['modo']) {
    case 'login':
        $login->login();
        break;
    case 'logout':
        $login->logout();
        break;
}