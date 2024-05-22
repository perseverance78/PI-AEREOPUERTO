<?php

class ManageUsersModel
{
    public function getTask()
    {
        // $where ="sro_id = $sro_id";
       
        $con = new Conexion();
        $sql = "SELECT 
                sro_id, 
                sro_nombre,
                sro_password, 
                sro_user, 
                sro_email, 
                rol_nombre, 
                sro_fechacreacion  
            FROM usuarios u 
            INNER JOIN rol r ON u.rol_id = r.rol_id ";
        $data = $con->select( $sql );
        return $data;

    }


    public function storeUser($data)
    {
        
        $sro_nombre = $data['sro_nombre'];
        $sro_user = $data['sro_user'];
        $sro_password = md5($data['sro_password']);
        $sro_email = $data['sro_email'];
        $rol_id = $data['rol_id'];
        $sro_fechacreacion = date('Y-m-d');
        $con = new Conexion();
        $sql = "INSERT INTO usuarios(
            sro_nombre,
            sro_user,
            sro_password,
            sro_email,
            rol_id,
            sro_fechacreacion
        )
        VALUES(
            '$sro_nombre',
            '$sro_user',
            '$sro_password',
            '$sro_email',
            '$rol_id',
            '$sro_fechacreacion'

        )";

        $result = $con->insert($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=user');
        }


    }

    public function deleteUserById($id){
        $con = new Conexion();
        $sql = "DELETE FROM usuarios WHERE sro_id = $id";
        $result = $con->delete( $sql );
        if($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=user');
        }
    }

    public function updateUser($data)
    {
        $sro_nombre = $data['sro_nombre'];
        $sro_password = md5($data['sro_password']);
        $sro_user = $data['sro_user'];
        $sro_email = $data['sro_email'];
        $rol_id = $data['rol_id'];
        $sro_id = $data['sro_id'];

        $con = new Conexion();
        $sql = "UPDATE usuarios 
                    SET sro_nombre = '$sro_nombre',
                    sro_password = '$sro_password',
                    sro_user = '$sro_user',
                    sro_email = '$sro_email',
                    rol_id = '$rol_id' 
                WHERE sro_id = $sro_id";

        $result = $con->update($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=user');
        }
    }


}