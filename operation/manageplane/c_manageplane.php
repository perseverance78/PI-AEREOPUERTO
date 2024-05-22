<?php
include_once 'm_manageplane.php';
include_once '../../conexion.php';
include_once '../../librerias/funciones.php';

class ManagePlaneController
{
    public function view()
    {
        include 'manageplane.tpl.php';
    }

    

    public function getPlane()
    {
       
        $model = new ManagePlaneModel();
        $data =$model->consultPlane();
        return $data;

    }

    public function createPlane()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $serie = $_POST['serie'];
            $model = $_POST['model'];
            $year = $_POST['year'];
            $airline = $_POST['airline'];
            $code = $_POST['code'];
            $passengers = $_POST['passengers'];
            $capacity = $_POST['capacity'];
            

            $data = array(
                
                'vno_numeroserie' => $serie,
                'vno_modelo' => $model,
                'vno_ayofabricacion' => $year,
                'rlna_id' => $airline,
                'vno_codigo' => $code,
                'vno_capacidadpasajeros' => $passengers,
                'vno_capacidadpeso' => $capacity,
                
            );

            $model = new ManagePlaneModel();
            $model->storePlane($data);



        }

    }

    public function modifyPlane()
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

            $model = new ManagePlaneModel();
            $model->updatePlane($data);



        }

    }

    public function deletePlane($id)
    {
      
        $model = new ManagePlaneModel();
        $model->deletePlaneById($id);
    }


}