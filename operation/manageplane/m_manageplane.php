<?php

class ManagePlaneModel
{

    public function consultPlane()
    {
   
       
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
        $vno_id = $data['vno_id'];
        $vno_numeroserie = $data['vno_numeroserie'];
        $vno_modelo = $data['vno_modelo'];
        $vno_ayofabricacion = $data['vno_ayofabricacion'];
        $rlna_id = $data['rlna_id'];
        $vno_codigo = $data['vno_codigo'];
        $vno_capacidadpasajeros = $data['vno_capacidadpasajeros'];
        $vno_capacidadpeso = $data['vno_capacidadpeso'];
       
        
        
        $con = new Conexion();
        $sql = "UPDATE avion SET 
                    vno_numeroserie = '$vno_numeroserie',
                    vno_modelo = '$vno_modelo',
                    vno_ayofabricacion = '$vno_ayofabricacion',
                    rlna_id = '$rlna_id',
                    vno_codigo = '$vno_codigo',
                    vno_capacidadpasajeros = $vno_capacidadpasajeros,
                    vno_capacidadpeso = '$vno_capacidadpeso'
                WHERE vno_id = $vno_id";

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