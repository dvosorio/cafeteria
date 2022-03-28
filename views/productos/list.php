<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafetería | Productos</title>

    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min">

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="assets/vendor/datatable/css/jquery.dataTables.min.css">
</head>
<body>
    <?php require("../layout/header.php") ?>

    <h3 class="text-center">Lista de Productos</h3><br>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-responsive">
                <table id="lista-productos" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Referencia</th>
                            <th>Precio</th>
                            <th>Peso</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Fecha de Ingreso</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery-3.5.1.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/popper/popper.min.js"></script>

    <!-- DataTable JS -->
    <script src="assets/vendor/datatable/js/jquery.dataTables.min.js"></script>
    <!-- DataTable JS -->

    <script src="assets/process/productos.js"></script>

    <script>
        $(document).ready(function(){
            ProcessProductos.listarProductos();
        })
    </script>
</body>
</html>