<?php
include_once 'c_searchflight.php';




$searchFlight = new SearchFlightController();
switch ($_REQUEST['modo']) {
    case 'createReserve':
        $searchFlight->createReserve();
        break;
    case 'searchFlight':
        $searchFlight->searchFlight();
    
}