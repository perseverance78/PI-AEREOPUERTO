<?php
include_once 'c_manageflight.php';


$manageFlight = new ManageFlightController();
switch ($_REQUEST['modo']) {
    case 'createFlight':
        $manageFlight->createFlight();
        break;
    case 'deleteFlight':
        $manageFlight->deleteFlight($_REQUEST['id']);
        break;
    case 'updateFlight':
        $manageFlight->modifyFlight();
        break;
    case 'view':
        $manageFlight->view();
        break;
}