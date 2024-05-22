<?php

class LoginController
{
   public function login()
   {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = $_POST['user'];
            $pass = md5($_POST['clave']);
            
            $data = array(
                'sro_user' => $user,
                'sro_password' => $pass
            );

            $this->vaidateUser($data);
        }

   }

   public function vaidateUser($data)
   {
        $model = new LoginModel();
        $resp = $model->getUser($data);
        $resp = current($resp);

        if(!empty($resp['sro_id']))
        {
            session_start();
            $_SESSION['user'] = $resp['sro_id'];
            $_SESSION['rol'] = $resp['rol_id'];
            header('Location:../operation/dashboard/dashboard.php');
        }else{
            header('Location:../index.php');
        }

       

        

   }

   public function logout()
   {
        session_start();
        session_unset();
        session_destroy();
        $_SESSION = array();
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        header('location: ../index.php');
   }
}
