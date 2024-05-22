<?php
include_once 'c_managereserve.php';


$manageReserve = new ManageReserveController();
switch ($_REQUEST['modo']) {
    case 'manageReserve':
        $manageReserve->manageReserve($_REQUEST['id'], $_REQUEST['manage'] );
        break;
    

}