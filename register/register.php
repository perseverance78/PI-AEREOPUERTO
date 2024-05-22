<?php
include_once 'c_register.php';
include_once 'm_register.php';
include_once '../conexion.php';

$register = new RegisterController();
switch ($_REQUEST['modo']) {
    case 'register':
        $register->form();
        break;
    case 'createUser':
        $register->createUser();
        break;
    default:
        
        break;
        
    
}