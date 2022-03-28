<?php
require("connect.php");
require("models/model_categorias.php");
date_default_timezone_set("America/Bogota");

switch ($_POST["type"]) {
    case 'Create':
        $categoria  = $_POST["categoria"];
        
        $response = Categorias::insertCategoria(array(
            "categoria" => $categoria,
            "fecha"     => date("Y-m-d H:i:s")
        ));

        break;
}

echo json_encode($response);
?>