<?php

class ManagePlaneModel
{

    public function consultPlane()
    {
        // $where ="sro_id = $sro_id";
       
        $con = new Conexion();
        $sql = "SELECT 
            vno_id,
            vno_numeroserie,
            vno_modelo,
            vno_ayofabricacion,
            rlna_id,
            vno_codigo,
            vno_capacidadpasajeros,
            vno_capacidadpeso
        FROM avion;";
        $data = $con->select( $sql );
        return $data;

    }


    public function storePlane($data)
    {
        
        $vno_numeroserie = $data['vno_numeroserie'];
        $vno_modelo = $data['vno_modelo'];
        $vno_ayofabricacion = $data['vno_ayofabricacion'];
        $rlna_id = $data['rlna_id'];
        $vno_codigo = $data['vno_codigo'];
        $vno_capacidadpasajeros = $data['vno_capacidadpasajeros'];
        $vno_capacidadpeso = $data['vno_capacidadpeso'];
        
        $con = new Conexion();
        $sql = "INSERT INTO avion(
            vno_numeroserie,
            vno_modelo,
            vno_ayofabricacion,
            rlna_id,
            vno_codigo,
            vno_capacidadpasajeros,
            vno_capacidadpeso
        )
        VALUES(
            '$vno_numeroserie',
            '$vno_modelo',
            '$vno_ayofabricacion',
            '$rlna_id',
            '$vno_codigo',
            $vno_capacidadpasajeros,
            '$vno_capacidadpeso'

        )";
        echo $sql;
        $result = $con->insert($sql);

        if ($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=plane');
        }


    }

    public function updatePlane($data)
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
            
            header('Location:../dashboard/dashboard.tpl.php?page=plane');
        }
    }


    public function deletePlaneById($id){
        $con = new Conexion();
        $sql = "DELETE FROM avion WHERE vno_id = $id";
        $result = $con->delete( $sql );
        if($result){
            
            header('Location:../dashboard/dashboard.tpl.php?page=plane');
        }
    }

}