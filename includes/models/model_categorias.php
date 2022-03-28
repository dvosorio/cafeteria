<?php

class Categorias
{
    public static function categoriaName($id)
    {
        $pdo = connect();

        $sql = "SELECT categoria FROM categorias WHERE id_categoria = ?";
        $sentencia = $pdo->prepare($sql);
        $sentencia->bind_param('i', $id);

        $sentencia->execute();
        $sentencia->bind_result($categoria);
        $sentencia->store_result();

        if ($sentencia->num_rows > 0) {
            $sentencia->fetch();

            $result = $categoria;
        } else {
            $result = 'Sin categoria';
        }

        $pdo->close();
        return $result;
    }

    public static function getCategorias()
    {
        $pdo = connect();

        $sql = "SELECT id_categoria, categoria FROM categorias";
        $sentencia = $pdo->prepare($sql);

        $sentencia->execute();
        $sentencia->bind_result($id_categoria, $categoria);
        $sentencia->store_result();

        if ($sentencia->num_rows > 0) {
            while ($filas = $sentencia->fetch()) {
                $result[] = array("id_categoria" => $id_categoria, "categoria" => $categoria);
            }

        } else {
            $result[] = array();
        }

        $pdo->close();
        return $result;
    }

    public static function insertCategoria($datos)
    {
        try {
            $pdo = connect();

            $sql = "INSERT INTO categorias(categoria, fecha) VALUES(?,?)";
            $sentencia = $pdo->prepare($sql);
            $sentencia->bind_param('ss', $datos["categoria"], $datos["fecha"]);
    
            if ($sentencia->execute()) {
                $result = array("ok" => true, "message" => "Se ha creado la categoria", "data" => self::getCategorias());
            } else {
                $result = array("ok" => false, "message" => "Error: " . $sentencia->error);
            }
            
            $pdo->close();
        } catch (\Throwable $th) {
            $result = array("ok" => false, "message" => "Code Error. M00005");
        }

        return $result;
    }
}

?>