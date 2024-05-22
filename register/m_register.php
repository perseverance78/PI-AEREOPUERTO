<?php

class Registermodel
{
    public function insert($data) 
    {
        $con = new Conexion();

        $sro_nombre = $data['sro_nombre'];
        $sro_user = $data['sro_user'];
        $sro_email = $data['sro_email'];
        $sro_password = md5($data['sro_password']);
        $sro_fechacreacion = date('Y-m-d');
        

        $sql = "INSERT INTO usuarios
        (
            sro_nombre,
            rol_id,
            sro_user,
            sro_email,
            sro_password,
            sro_fechacreacion
        )
        VALUES
        (
            '$sro_nombre',
            2,
            '$sro_user',
            '$sro_email',
            '$sro_password',
            '$sro_fechacreacion'
            
           
        );";

        $result = $con->insert( $sql );

        if($result){
            
            header('location: ../index.php');
        }
    }

}