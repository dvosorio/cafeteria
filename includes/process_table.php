<?php
require("connect.php");
require("debug.php");
require("models/model_productos.php");
require("models/model_categorias.php");
require("libs/ssp.class.php");

global $host;
global $user;
global $pass;
global $db;


$table = 'productos';
$primaryKey = 'id_producto';

$columns = array(
    array( 'db' => 'id_producto', 'dt' => 0 ),
    array( 'db' => 'producto', 'dt' => 1 ),
    array( 'db' => 'referencia', 'dt' => 2 ),
    array( 'db' => 'precio', 'dt' => 3 ),
    array( 'db' => 'peso', 'dt' => 4 ),
    array(
        'db' => 'id_categoria',
        'dt' => 5,
        'formatter' => function( $d, $row ) {
            return Categorias::categoriaName($d);
        }
    ),
    array( 'db' => 'stock', 'dt' => 6 ),
    array( 'db' => 'fecha_ingreso', 'dt' => 7 ),
    array(
        'db' => 'id_producto',
        'dt' => 8,
        'formatter' => function( $d, $row ) {
            return '
            <div class="btn-group">
                <a href="editar-prodctos/'.$d.'" class="btn btn-primary btn-sm" role="button">
                    <i class="fa fa-edit"></i>
                </a>
                <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item eliminarProducto" data-control="'.$d.'" href="#">Eliminar</a>
                </div>
            </div>
            ';
        }
    ),
);

$sql_details = array(
    'user' => $user,
    'pass' => $pass,
    'db'   => $db,
    'host' => $host
);

echo json_encode(
    SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, '', 'status = \'1\'' )
);
?>