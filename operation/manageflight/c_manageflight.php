<?php
include_once 'm_manageflight.php';
include_once '../../conexion.php';
include_once '../../librerias/funciones.php';

class ManageFlightController
{
    public function view()
    {
        include 'manageflight.tpl.php';
    }

    

    public function getFlight()
    {
       
        $model = new ManageFlightModel();
        $data =$model->consultFlight();
        return $data;

    }

    public function createFlight()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $date = $_POST['date'];
            $hour = $_POST['hour'];
            $pilot = $_POST['pilot'];
            $plane = $_POST['plane'];
            $origin = $_POST['origin'];
            $destination = $_POST['destination'];
            

            $data = array(
                'vlso_fecha' => $date,
                'vlso_hora' => $hour,
                'vlso_piloto' => $pilot,
                'vlso_avion' => $plane,
                'vlso_origen' => $origin,
                'vlso_destino' => $destination
            );

            $model = new ManageFlightModel();
            $model->storeFlight($data);



        }

    }

    public function modifyFlight()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $id = $_POST['id'];
            $date = $_POST['date'];
            $hour = $_POST['hour'];
            $pilot = $_POST['pilot'];
            $plane = $_POST['plane'];
            $origin = $_POST['origin'];
            $destination = $_POST['destination'];

            $data = array(
                'vlso_id' => $id,
                'vlso_fecha' => $date,
                'vlso_hora' => $hour,
                'vlso_piloto' => $pilot,
                'vlso_avion' => $plane,
                'vlso_origen' => $origin,
                'vlso_destino' => $destination
            );

            $model = new ManageFlightModel();
            $model->updateFlight($data);



        }

    }

    public function deleteFlight($id)
    {
      
        $model = new ManageFlightModel();
        $model->deleteFlightById($id);
    }


}