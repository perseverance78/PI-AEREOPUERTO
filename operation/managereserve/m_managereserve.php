<?php

class ManageReserveModel
{

    public function consultReserve()
    {
        // $where ="sro_id = $sro_id";
       
        $con = new Conexion();
        $sql = "SELECT 
            rsva_id,
            sro_nombre,
            rsva_totalpasajeros,
            rsva_origen,
            rsva_destino,
            rsva_fechasalida,
            rsva_fechallegada,
            rsva_horasalida,
            rsva_horallegada,
            vlso_id,
            rsva_clase,
            rsva_estado,
            rsva_precio,
            rsva_metodopago,
            rsva_email,
            rsva_fechacreacion
        FROM reserva r INNER JOIN usuarios u ON r.sro_id = u.sro_id ;";
        $data = $con->select( $sql );
        return $data;

    }


    

    public function updateReserve($id, $manage)
    {

        $con = new Conexion();
        $sql = "UPDATE reserva 
                    SET rsva_estado = '$manage'
                WHERE rsva_id = $id";

        $result = $con->update($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=reserve');
        }
    }


    public function deleteReserveById($id){
        $con = new Conexion();
        $sql = "DELETE FROM vuelos WHERE vlso_id = $id";
        $result = $con->delete( $sql );
        if($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=reserve');
        }
    }

}