<?php
require("connect.php");
require("models/model_productos.php");
date_default_timezone_set("America/Bogota");

switch ($_POST["type"]) {
    case 'Create':
        $producto       = $_POST["producto"];
        $id_categoria   = $_POST["categoria"];
        $precio         = ((is_numeric($_POST["precio"]))?$_POST["precio"]:0);
        $peso           = ((is_numeric($_POST["peso"]))?$_POST["peso"]:0);
        $stock          = ((is_numeric($_POST["stock"]))?$_POST["stock"]:0);
        $referencia     = $_POST["referencia"];
        $seguir         = true;
        
        if (Productos::validarNombreProducto($producto)) {
            $response = array("ok" => false, "message" => 'Ese nombre de producto ya existe');
            $seguir = false;
        }

        if ($seguir && ($precio == 0 || $peso == 0 || $stock == 0)) {
            $response = array("ok" => false, "message" => 'El campo precio, peso ni stock pueden estar en cero');
            $seguir = false;
        }

        if ($seguir) {
            $response = Productos::insertProducto(array(
                "producto"      => $producto,
                "id_categoria"  => $id_categoria, 
                "precio"        => $precio, 
                "peso"          => $peso, 
                "stock"         => $stock, 
                "referencia"    => $referencia, 
                "fecha"         => date("Y-m-d H:i:s")
            ));
        }

        break;

    case 'Update':
        $id_producto    = ((is_numeric($_POST["id_producto"]))?$_POST["id_producto"]:0);
        $producto       = $_POST["producto"];
        $id_categoria   = $_POST["categoria"];
        $precio         = ((is_numeric($_POST["precio"]))?$_POST["precio"]:0);
        $peso           = ((is_numeric($_POST["peso"]))?$_POST["peso"]:0);
        $stock          = ((is_numeric($_POST["stock"]))?$_POST["stock"]:0);
        $referencia     = $_POST["referencia"];
        $seguir         = true;
        
        if ($id_producto == 0) {
            $response = array("ok" => false, "message" => 'ID de producto invalido');
            $seguir = false;
        }

        if ($seguir && ($precio == 0 || $peso == 0 || $stock == 0)) {
            $response = array("ok" => false, "message" => 'El campo precio, peso ni stock pueden estar en cero');
            $seguir = false;
        }

        if ($seguir) {
            $response = Productos::updateProducto(array(
                "producto"      => $producto,
                "id_categoria"  => $id_categoria, 
                "precio"        => $precio, 
                "peso"          => $peso, 
                "stock"         => $stock, 
                "referencia"    => $referencia, 
                "id_producto"   => $id_producto
            ));
        }
        break;

    case 'Delete':
        $id_producto    = ((is_numeric($_POST["id_producto"]))?$_POST["id_producto"]:0);
        $seguir         = true;

        if ($id_producto == 0) {
            $response = array("ok" => false, "message" => 'ID de producto invalido');
            $seguir = false;
        }

        if ($seguir) {
            $response = Productos::deleteProducto(array(
                "id_producto"   => $id_producto
            ));
        }
        break;
}

echo json_encode($response);
?>