<?php

class Productos
{

    public static function productosData($id_producto)
    {
        $pdo = connect();

        $sql = "SELECT producto, referencia, precio, peso, id_categoria, stock FROM productos WHERE id_producto = ?";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bind_param('i', $id_producto);

        $sentencia->execute();
        $sentencia->bind_result($producto, $referencia, $precio, $peso, $id_categoria, $stock);
        $sentencia->store_result();

        if ($sentencia->num_rows > 0) {
            $sentencia->fetch();
            $result = array("producto" => $producto, "referencia" => $referencia, "precio" => $precio, "peso" => $peso, "id_categoria" => $id_categoria, "stock" => $stock);

        } else {
            $result = array("producto" => '', "referencia" => '', "precio" => '', "peso" => '', "id_categoria" => '', "stock" => '');
        }

        $pdo->close();
        return $result;
    }

    public static function productosTienda()
    {
        $pdo = connect();

        $sql = "SELECT id_producto, producto, referencia, precio FROM productos WHERE status = '1'";
        $sentencia = $pdo->prepare($sql);

        $sentencia->execute();
        $sentencia->bind_result($id_producto, $producto, $referencia, $precio);
        $sentencia->store_result();

        if ($sentencia->num_rows > 0) {
            while ($filas = $sentencia->fetch()) {
                $result[] = array("id_producto" => $id_producto, "producto" => $producto, "referencia" => $referencia, "precio" => $precio);
            }

        } else {
            $result[] = array("id_producto" => '', "producto" => '', "referencia" => '', "precio" => '');
        }

        $pdo->close();
        return $result;
    }

    public static function validarNombreProducto($producto)
    {
        $pdo = connect();

        $sql = "SELECT id_producto FROM productos WHERE producto = ?";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bind_param('s', $producto);

        $sentencia->execute();
        $sentencia->bind_result($id_producto);
        $sentencia->store_result();

        if ($sentencia->num_rows == 0) {
            $result = false;
        } else {
            $result = true;
        }

        $pdo->close();
        return $result;
    }

    public static function insertProducto($datos)
    {
        try {
            $pdo = connect();

            $sql = "INSERT INTO productos(producto, referencia, precio, peso, id_categoria, stock, fecha_ingreso) VALUES(?,?,?,?,?,?,?)";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bind_param('ssssiis', $datos["producto"], $datos["referencia"], $datos["precio"], $datos["peso"], $datos["id_categoria"], $datos["stock"], $datos["fecha"]);
    
            if ($sentencia->execute()) {
                $result = array("ok" => true, "message" => "Se ha creado el producto");
            } else {
                $result = array("ok" => false, "message" => "Error: " . $sentencia->error);
            }
            
            $pdo->close();
        } catch (\Throwable $th) {
            $result = array("ok" => false, "message" => "Code Error. M00001");
        }

        return $result;
    }

    public static function updateProducto($datos)
    {
        try {
            $pdo = connect();

            $sql = "UPDATE productos SET producto = ?, referencia = ?, precio = ?, peso = ?, id_categoria = ?, stock = ? WHERE id_producto = ?";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bind_param('ssssiii', $datos["producto"], $datos["referencia"], $datos["precio"], $datos["peso"], $datos["id_categoria"], $datos["stock"], $datos["id_producto"]);
    
            if ($sentencia->execute()) {
                $result = array("ok" => true, "message" => "Se ha actualizado el producto");
            } else {
                $result = array("ok" => false, "message" => "Error: " . $sentencia->error);
            }
            
            $pdo->close();
        } catch (\Throwable $th) {
            $result = array("ok" => false, "message" => "Code Error. M00002");
        }

        return $result;
    }

    public static function deleteProducto($datos)
    {
        try {
            $pdo = connect();

            // $sql = "DELETE FROM productos WHERE id_producto = ?";
            $sql = "UPDATE productos SET status = '0' WHERE id_producto = ?";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bind_param('i', $datos["id_producto"]);
    
            if ($sentencia->execute()) {
                $result = array("ok" => true, "message" => "Se ha eliminado el producto");
            } else {
                $result = array("ok" => false, "message" => "Error: " . $sentencia->error);
            }
            
            $pdo->close();
        } catch (\Throwable $th) {
            $result = array("ok" => false, "message" => "Code Error. M00003");
        }

        return $result;
    }

    public static function validarCantidad($id_producto, $cantidad)
    {
        $pdo = connect();

        $sql = "SELECT stock FROM productos WHERE id_producto = ?";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bind_param('s', $id_producto);

        $sentencia->execute();
        $sentencia->bind_result($stock);
        $sentencia->store_result();

        if ($sentencia->num_rows > 0) {
            $sentencia->fetch();
            $result = (($cantidad <= $stock)?false:true);
        } else {
            $result = true;
        }

        $pdo->close();
        return $result;
    }

    public static function debitarStock($id_producto, $cantidad)
    {
        try {
            $pdo = connect();

            $sql = "UPDATE productos SET stock = stock - ? WHERE id_producto = ?";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bind_param('ii', $cantidad, $id_producto);
    
            if ($sentencia->execute()) {
                $result = array("ok" => true, "message" => "Se ha debitado el stock");
            } else {
                $result = array("ok" => false, "message" => "Error: " . $sentencia->error);
            }
            
            $pdo->close();
        } catch (\Throwable $th) {
            $result = array("ok" => false, "message" => "Code Error. M00002");
        }

        return $result;
    }
}

?>