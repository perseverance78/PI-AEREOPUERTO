<?php
include_once 'm_managepilot.php';
include_once '../../conexion.php';
include_once '../../librerias/funciones.php';

class ManagePilotController
{
    public function view()
    {
        include 'managepilot.tpl.php';
    }

    

    public function getPilot()
    {
       
        $model = new ManagePilotModel();
        $data =$model->consultPilot();
        return $data;

    }

    public function createPilot()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $name = $_POST['name'];
            $birthdate = $_POST['birthdate'];
           
            $nationality = $_POST['nationality'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            $data = array(
                'plto_nombre' => $name,  
                'plto_fechanacimiento' => $birthdate,  
                'plto_nacionalidad' => $nationality,  
                'plto_telefono' => $phone,  
                'plto_email' => $email,
            );

            $model = new ManagePilotModel();
            $model->storePilot($data);



        }

    }

    public function modifyPilot()
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

            $model = new ManagePilotModel();
            $model->updatePilot($data);



        }

    }

    public function deletePilot($id)
    {
      
        $model = new ManagePilotModel();
        $model->deletePilotById($id);
    }


}