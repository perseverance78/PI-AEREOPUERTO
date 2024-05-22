<?php

class SearchFlightModel
{

    public function consultReserve($id)
    {
        $where ="u.sro_id = $id";
       
        $con = new Conexion();
        $sql = "SELECT 
            rsva_id,
            rsva_totalpasajeros,
            rsva_origen,
            rsva_destino,
            rsva_fechasalida,
            rsva_horasalida,
            rsva_estado,
            rsva_fechacreacion
        FROM reserva r INNER JOIN usuarios u ON r.sro_id = u.sro_id WHERE $where ;";
        $data = $con->select( $sql );
        return $data;

    }
  


    public function storeReserve($data)
    {
        
        $rsva_fechasalida = $data['rsva_fechasalida'];
        $rsva_horasalida = $data['rsva_horasalida'];
        $rsva_origen = $data['rsva_origen'];
        $rsva_destino = $data['rsva_destino'];
        $rsva_totalpasajeros = $data['rsva_totalpasajeros'];
        $sro_id = $data['sro_id'];
        $rsva_fechacreacion = date('Y-m-d');
        $con = new Conexion();
        $sql = "INSERT INTO reserva(
            rsva_fechasalida,
            rsva_horasalida,
            rsva_origen,
            rsva_destino,
            rsva_totalpasajeros,
            sro_id,
            rsva_fechacreacion,
            rsva_estado
        )
        VALUES(
            '$rsva_fechasalida',
            '$rsva_horasalida',
            '$rsva_origen',
            '$rsva_destino',
            $rsva_totalpasajeros,
            $sro_id,
            '$rsva_fechacreacion',
            'EN ESPERA'

        )";

        $result = $con->insert($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=searchflight');
        }


    }

    public function filterFlight($where)
    {
       
        $con = new Conexion();
        $sql = "SELECT 
            vlso_id,
            vlso_fecha, 
            vlso_hora,
            vlso_piloto, 
            vlso_avion,
            vlso_origen,
            vlso_destino
        FROM vuelos $where;";
        $data = $con->select( $sql );
        return $data;

    }



}