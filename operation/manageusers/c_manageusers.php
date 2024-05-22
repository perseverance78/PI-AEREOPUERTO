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
        $data =$model->getUsers();
        return $data;

    }

    public function getUserById($id)
    {
        $model = new ManageUsersModel();
        $data =$model->consultUser($id);
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
        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $password = $_POST['pass'];
            $user = $_POST['user'];
            $email = $_POST['email'];
            if ($_SESSION['rol' == 1]) {
                $rol = $_POST['rol'];
            }else{
                $rol = 2;
            }
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