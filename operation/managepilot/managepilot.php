<?php
include_once 'c_managepilot.php';


$managePilot = new ManagePilotController();
switch ($_REQUEST['modo']) {
    case 'createPilot':
        $managePilot->createPilot();
        break;
    case 'deletePilot':
        $managePilot->deletePilot($_REQUEST['id']);
        break;
    case 'updatePilot':
        $managePilot->modifyPilot();
        break;
    case 'view':
        $managePilot->view();
        break;
}