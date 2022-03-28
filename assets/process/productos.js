var ProcessProductos = {
    crearProducto: () => {
        $("form[name=ProductosForm]").submit(function (e) { 
            e.preventDefault();
            
            $("button[name=btnGuadraProducto]").html("<i class=\"fa fa-spinner fa-spin\"></i> Por favor espere...").attr("disabled");

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "includes/process_productos.php",
                data: $("form[name=ProductosForm]").serialize(),
                success: (response) => {
                    const { ok, message } = response
                    alert(message);

                    if (ok) {
                        $("button[name=btnGuadraProducto]").html("<i class=\"fa fa-save\"></i> Guardar").removeAttr("disabled");

                        $("form[name=ProductosForm]")[0].reset();
                    }
                },
                error: () => {
                    console.error("Hubo un problema al insertar el producto");
                }
            });
        });
    },
    listarProductos: () => {
        var self = this
		var table = $("#lista-productos").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": 'includes/process_table.php',
            "order": [[0, "asc"]],
            "pageLength": 25,
        })

        table.on('draw', function(){
            $(".eliminarProducto").on('click', function(){
                var id = $(this).attr('data-control');
                ProcessProductos.eliminarProducto(table, id)
            })
        });
    },
    eliminarProducto: (table, id) => {
        $.ajax({
            type: "POST",
            url: "includes/process_productos",
            data: {"type":"Delete", "id_producto":id},
            dataType: "json",
            success: (response) => {
                const { ok, message } = response
                alert(message)

                if (ok) {
                    table.ajax.reload()
                }
            },
            error: () => {
                console.error("Hubo un error al procesar la solicitus");
            }
        });
    },
    editarProducto: () => {
        $("form[name=ProductosFormEditar]").submit(function (e) { 
            e.preventDefault();
            
            $("button[name=btnEditarProducto]").html("<i class=\"fa fa-spinner fa-spin\"></i> Por favor espere...").attr("disabled");

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "../includes/process_productos.php",
                data: $("form[name=ProductosFormEditar]").serialize(),
                success: (response) => {
                    const { ok, message } = response
                    alert(message);

                    if (ok) {
                        $("button[name=btnEditarProducto]").html("<i class=\"fa fa-save\"></i> Guardar").removeAttr("disabled");
                    }
                },
                error: () => {
                    console.error("Hubo un problema al actualizar el producto");
                }
            });
        });
    }
}