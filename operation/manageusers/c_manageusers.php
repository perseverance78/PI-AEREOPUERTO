<?php
include_once 'm_manageusers.php';
include_once '../../conexion.php';
include_once '../../librerias/funciones.php';
class ManageUsersController
{
    public function view()
    {
        include 'manageusers.tpl.php';
    }

    public function getUser()
    {
       
        $model = new ManageUsersModel();
        $data =$model->getTask();
        return $data;

    }


    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $user = $_POST['user'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];

            $data = array(
                'sro_nombre' => $name,
                'sro_user' => $user,
                'sro_password' => $password,
                'sro_email' => $email,
                'rol_id' => $rol
            );

            $model = new ManageUsersModel();
            $model->storeUser($data);



        }

    }

    public function modifyUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $password = $_POST['pass'];
            $user = $_POST['user'];
            $email = $_POST['email'];
            $rol = $_POST['rol'];
            $id = $_POST['id'];

            $data = array(
                'sro_nombre' => $name,
                'sro_password' => $password,
                'sro_user' => $user,
                'sro_email' => $email,
                'rol_id' => $rol,
                'sro_id' => $id
            );

            $model = new ManageUsersModel();
            $model->updateUser($data);



        }

    }

    public function deleteUser($id)
    {
      
        $model = new ManageUsersModel();
        $model->deleteUserById($id);
    }
}