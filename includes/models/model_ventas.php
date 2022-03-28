<?php

class Ventas
{
    public static function insertVenta($datos)
    {
        try {
            $pdo = connect();

            $sql = "INSERT INTO ventas(id_producto, cantidad, total, fecha_ingreso) VALUES(?,?,?,?)";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bind_param('iiss', $datos["id_producto"], $datos["cantidad"], $datos["total"], $datos["fecha"]);
    
            if ($sentencia->execute()) {
                $result = array("ok" => true, "message" => "La compra se ha realizado");
                Productos::debitarStock($datos["id_producto"], $datos["cantidad"]);
            } else {
                $result = array("ok" => false, "message" => "Error: " . $sentencia->error);
            }
            
            $pdo->close();
        } catch (\Throwable $th) {
            $result = array("ok" => false, "message" => "Code Error. M00004");
        }

        return $result;
    }
}

?>