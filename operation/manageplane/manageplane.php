<?php
include_once 'c_manageplane.php';


$managePlane = new ManagePlaneController();
switch ($_REQUEST['modo']) {
    case 'createPlane':
        $managePlane->createPlane();
        break;
    case 'deletePlane':
        $managePlane->deletePlane($_REQUEST['id']);
        break;
    case 'updatePlane':
        $managePlane->modifyPlane();
        break;
    case 'view':
        $managePlane->view();
        break;
}