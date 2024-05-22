<?php
include_once 'm_managereserve.php';
include_once '../../conexion.php';
include_once '../../librerias/funciones.php';

class ManageReserveController
{
    public function view()
    {
        include 'managereserve.tpl.php';
    }

    

    public function getReserve()
    {
       
        $model = new ManageReserveModel();
        $data =$model->consultReserve();
        return $data;

    }

   
    

    public function manageReserve($id, $manage)
    {
        $model = new ManageReserveModel();
        $model->updateReserve($id, $manage);
    }


}