var ProcessTienda = {
    tienda: () => {
        $(".btnAdd").click(function (e) { 
            e.preventDefault();
            
            var id = $(this).attr('data-control');
            var cantidad = $(`#cantidad_${id}`).val();
            var precio   = $(`#precio_${id}`).val();
            
            if (cantidad > 0) {
                var total = precio * cantidad;
                if (confirm(`Total de $${total}, si desea continuar con la compra por favor de click en aceptar`)) {
                    $.ajax({
                        type: "POST",
                        url: "includes/process_tienda",
                        data: {"type":"buyProduct", "id_producto":id, "cantidad":cantidad, "total":total},
                        dataType: "json",
                        success: (response) => {
                            const { message } = response
                            alert(message)
                        },
                        error: () => {
                            console.error("Hubo un error al procesar la solicitus");
                        }
                    });
                }
            } else {
                alert("La cantidad no puede estar en cero")
            }
        });
    }
}