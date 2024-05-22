<?php

class LoginModel
{
    public function getUser($data)
    {
        $sro_user = $data['sro_user'];
        $sro_password = $data['sro_password'];

        $where = '1 = 1';
        $where.= " AND sro_user = '$sro_user' AND sro_password = '$sro_password'";
        $con = new Conexion();
        $sql ="SELECT sro_id, rol_id
        FROM usuarios WHERE $where;";
       
        $data = $con->select($sql);

        return $data;

    }
}