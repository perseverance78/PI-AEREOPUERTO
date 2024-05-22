<?php

class ManagePilotModel
{

    public function consultPilot()
    {
        // $where ="sro_id = $sro_id";
       
        $con = new Conexion();
        $sql = "SELECT 
            plto_id,
            plto_nombre,
            plto_fechanacimiento,
            plto_genero,
            plto_nacionalidad,
            plto_fechacreacion,
            plto_telefono,
            plto_email
        FROM piloto;";
        $data = $con->select( $sql );
        return $data;

    }


    public function storePilot($data)
    {
        $plto_nombre = $data['plto_nombre'];
        $plto_fechanacimiento = $data['plto_fechanacimiento'];
        $plto_nacionalidad = $data['plto_nacionalidad'];
        $plto_telefono = $data['plto_telefono'];
        $plto_email = $data['plto_email'];
        $plto_fechacreacion = date('Y-m-d');
        $con = new Conexion();
        $sql = "INSERT INTO piloto (
            plto_nombre,
            plto_fechanacimiento,
            
            plto_nacionalidad,
            plto_fechacreacion,
            plto_telefono,
            plto_email
        )
        VALUES(
            '$plto_nombre',
            '$plto_fechanacimiento',
            '$plto_nacionalidad',
            '$plto_fechacreacion',
            '$plto_telefono',
            '$plto_email'

        )";
        $result = $con->insert($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=pilot');
        }


    }

    public function updatePilot($data)
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
            
            header('Location:../dashboard/dashboard.tpl.php?page=pilot');
        }
    }


    public function deletePilotById($id){
        $con = new Conexion();
        $sql = "DELETE FROM piloto WHERE plto_id = $id";
        $result = $con->delete( $sql );
        if($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=pilot');
        }
    }

}