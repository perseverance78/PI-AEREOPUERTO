<?php

class ManageFlightModel
{

    public function consultFlight()
    {
        // $where ="sro_id = $sro_id";
       
        $con = new Conexion();
        $sql = "SELECT 
            vlso_id,
            vlso_fecha, 
            vlso_hora,
            vlso_piloto, 
            vlso_avion,
            vlso_origen,
            vlso_destino
        FROM vuelos;";
        $data = $con->select( $sql );
        return $data;

    }


    public function storeFlight($data)
    {
        
        $vlso_fecha = $data['vlso_fecha'];
        $vlso_hora = $data['vlso_hora'];
        $vlso_piloto = $data['vlso_piloto'];
        $vlso_avion = $data['vlso_avion'];
        $vlso_origen = $data['vlso_origen'];
        $vlso_destino = $data['vlso_destino'];
        $con = new Conexion();
        $sql = "INSERT INTO vuelos(
            vlso_fecha,
            vlso_hora,
            vlso_piloto,
            vlso_avion,
            vlso_origen,
            vlso_destino
        )
        VALUES(
            '$vlso_fecha',
            '$vlso_hora',
            '$vlso_piloto',
            '$vlso_avion',
            '$vlso_origen',
            '$vlso_destino'

        )";
        $result = $con->insert($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=flight');
        }


    }

    public function updateFlight($data)
    {
        $vlso_id = $data['vlso_id'];
        $vlso_fecha = $data['vlso_fecha'];
        $vlso_hora = $data['vlso_hora'];
        $vlso_piloto = $data['vlso_piloto'];
        $vlso_avion = $data['vlso_avion'];
        $vlso_origen = $data['vlso_origen'];
        $vlso_destino = $data['vlso_destino'];
        
        
        $con = new Conexion();
        $sql = "UPDATE vuelos 
                    SET 
                    vlso_fecha = '$vlso_fecha',
                    vlso_hora = '$vlso_hora',
                    vlso_piloto = '$vlso_piloto',
                    vlso_avion = '$vlso_avion',
                    vlso_origen = '$vlso_origen',
                    vlso_destino = '$vlso_destino'
                WHERE vlso_id = $vlso_id";

        $result = $con->update($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=flight');
        }
    }


    public function deleteFlightById($id){
        $con = new Conexion();
        $sql = "DELETE FROM vuelos WHERE vlso_id = $id";
        $result = $con->delete( $sql );
        if($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=flight');
        }
    }

}