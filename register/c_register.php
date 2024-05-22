<?php

class RegisterController
{
    public function form()
    {
        include 'v_register.tpl.html';
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];

            $data = array(
                'sro_nombre' => $nombre,
                'sro_email' => $correo,
                'sro_user' => $usuario,
                'sro_password' => $clave
            );

            $model = new RegisterModel();
            $model->insert($data);


        }
    }
}