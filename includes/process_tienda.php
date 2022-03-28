<?php
require("connect.php");
require("models/model_productos.php");
require("models/model_ventas.php");
date_default_timezone_set("America/Bogota");

switch ($_POST["type"]) {
    case 'buyProduct':
        $id_producto    = $_POST["id_producto"];
        $cantidad       = $_POST["cantidad"];
        $precio_total   = $_POST["total"];
        $seguir         = true;

        if ($seguir && Productos::validarCantidad($id_producto, $cantidad)) {
            $response   = array("ok" => false, "message" => 'La cantidad solicitada no esta disponible');
            $seguir     = false;
        }

        if ($seguir) {
            $response = Ventas::insertVenta(array(
                "id_producto"   => $id_producto,
                "cantidad"      => $cantidad,
                "total"         => $precio_total,
                "fecha"         => date("Y-m-d H:i:s")
            ));
        }

        break;
}

echo json_encode($response);
?>