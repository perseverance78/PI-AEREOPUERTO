<?php
include_once 'm_searchflight.php';
include_once '../../conexion.php';
include_once '../../librerias/funciones.php';
class SearchFlightController
{
    public function view()
    {
        include 'manageusers.tpl.php';
    }

    public function getReserveById($sro_id)
    {
       
        $model = new SearchFlightModel();
        $data =$model->consultReserve($sro_id);
        return $data;

    }


    public function createReserve()
    {
        session_start();
        $sro = $_SESSION['user'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $departuredate = $_POST['departuredate'];
            $departuretime = $_POST['departuretime'];
            $origin = $_POST['origin'];
            $destination = $_POST['destination'];
            $totalpassengers = $_POST['totalpassengers'];

            $data = array(
                'rsva_fechasalida' => $departuredate,
                'rsva_horasalida' => $departuretime,
                'rsva_origen' => $origin,
                'rsva_destino' => $destination,
                'rsva_totalpasajeros' => $totalpassengers,
                'sro_id' => $sro
            );

            $model = new SearchFlightModel();
            $model->storeReserve($data);



        }

    }

    
}