<?php
include_once 'c_manageusers.php';




$manageUsers = new ManageUsersController();
switch ($_REQUEST['modo']) {
    case 'createUser':
        $manageUsers->createUser();
        break;
    case 'deleteUser':
        $manageUsers->deleteUser($_REQUEST['id']);
        break;
    case 'updateUser':
        $manageUsers->modifyUser();
        break;
    case 'view':
        $manageUsers->view();
        break;
}