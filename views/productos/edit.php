<?php
require("../../includes/connect.php");
require("../../includes/models/model_productos.php");
require("../../includes/models/model_categorias.php");

$id_producto = $_GET["id"];

$productos  = Productos::productosData($id_producto);
$categorias = Categorias::getCategorias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafetería | Productos Editar</title>

    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min">
</head>
<body>
    <?php require("../layout/header.php") ?>

    <h3 class="text-center">Editar Producto</h3><br>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form name="ProductosFormEditar" id="ProductosForm" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <input type="text" class="form-control" name="producto" id="producto" value="<?= $productos["producto"] ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" step="1.0" min="1" class="form-control" name="precio" id="precio" value="<?= $productos["precio"] ?>" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping">$</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" min="1" class="form-control" name="stock" id="stock"value="<?= $productos["stock"] ?>"  required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categorias</label>
                            <select name="categoria" id="categoria" class="form-control" required>
                                <option value="">Seleccione</option>
                                <?php if(!empty($categorias)): ?>
                                    <?php foreach ($categorias as $key => $value): ?>
                                        <option value="<?= $value["id_categoria"] ?>" <?= (( $productos["id_categoria"] == $value["id_categoria"])?'selected':'') ?>><?= $value["categoria"] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" min="1" class="form-control" name="peso" id="peso" value="<?= $productos["peso"] ?>" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping">gr</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" class="form-control" name="referencia" id="referencia" value="<?= $productos["referencia"] ?>" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="type" value="Update">
                        <input type="hidden" name="id_producto" value="<?= $id_producto ?>">
                        <button name="btnEditarProducto" type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Editar</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <script src="../assets/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/popper/popper.min.js"></script>

    <script src="../assets/process/productos.js"></script>

    <script>
        $(document).ready(function(){
            ProcessProductos.editarProducto();
        })
    </script>
</body>
</html>