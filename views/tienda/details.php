<?php
require("../../includes/connect.php");
require("../../includes/models/model_productos.php");

$productos  = Productos::productosTienda();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafetería | Tienda</title>

    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min">
</head>
<body>
    <?php require("../layout/header.php") ?>

    <div class="container">
        <h3 class="text-center">Tienda</h3><br>

        <?php if(!empty($productos)): ?>
            <div class="row justify-content-center">
                <?php foreach($productos as $key => $value): ?>
                    <div class="col-md-4" style="padding-top: 30px;">
                        <div class="card" style="width: 18rem;">
                            <img src="assets/img/producto-sin-imagen.jpg" class="card-img-top" alt="Producto sin Foto">
                            <div class="card-body">
                                <h5 class="card-title"><?= $value["producto"] ?></h5>
                                <p class="card-text"><?= $value["referencia"] ?></p>
                                <p class="card-text">$<?= $value["precio"] ?></p>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-primary btn-sm btnAdd" data-control="<?= $value["id_producto"] ?>">Buy</button>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="hidden" id="precio_<?= $value["id_producto"] ?>" value="<?= $value["precio"] ?>">
                                        <input type="number" class="form-control form-control-sm" min="1" id="cantidad_<?= $value["id_producto"] ?>" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php else: ?>
            <p class="text-center">No hay productos disponibles, por favor da click <a href="crear-productos" class="btn btn-link">aquí</a> para registrar un producto</p>
        <?php endif ?>
    </div>


    

    <script src="assets/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/popper/popper.min.js"></script>

    <script src="assets/process/tienda.js"></script>

    <script>
        $(document).ready(function(){
            ProcessTienda.tienda();
        })
    </script>
</body>
</html>