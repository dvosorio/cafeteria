<?php
require("../../includes/connect.php");
require("../../includes/models/model_productos.php");
require("../../includes/models/model_categorias.php");

$categorias = Categorias::getCategorias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafetería | Productos Crear</title>

    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min">
</head>
<body>
    <?php require("../layout/header.php") ?>

    <h3 class="text-center">Crear Producto</h3><br>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form name="ProductosForm" id="ProductosForm" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <input type="text" class="form-control" name="producto" id="producto" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" step="1.0" min="1" class="form-control" name="precio" id="precio" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping">$</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" min="1" class="form-control" name="stock" id="stock" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="categoria">Categorias</label>
                            <div class="input-group flex-nowrap">
                                <select name="categoria" id="categoria" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <?php if(!empty($categorias)): ?>
                                        <?php foreach ($categorias as $key => $value): ?>
                                            <option value="<?= $value["id_categoria"] ?>"><?= $value["categoria"] ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                                <div class="input-group-prepend">
                                    <span class="input-group-text openModal" id="addon-wrapping"><i class="fa fa-plus"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="peso">Peso</label>
                            <div class="input-group flex-nowrap">
                                <input type="number" min="1" class="form-control" name="peso" id="peso" required>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="addon-wrapping">gr</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="referencia">Referencia</label>
                            <input type="text" class="form-control" name="referencia" id="referencia" required>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <input type="hidden" name="type" value="Create">
                        <button name="btnGuadraProducto" type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form name="FormCategorias">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <input type="text" class="form-control" placeholder="Nombre Categoria" name="categoria" required>
                                <input type="hidden" name="type" value="Create">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnCategoria"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/popper/popper.min.js"></script>

    <script src="assets/process/categorias.js"></script>
    <script src="assets/process/productos.js"></script>

    <script>
        $(document).ready(function(){
            ProcessProductos.crearProducto();
            ProcessCategorias.crearCategoria();

            $(".openModal").click(() => {
                $("#exampleModal").modal("show")
            })
        })
    </script>
</body>
</html>