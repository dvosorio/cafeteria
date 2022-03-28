var ProcessCategorias = {
    crearCategoria: () => {
        $("form[name=FormCategorias]").submit(function (e) { 
            e.preventDefault();
            
            $("button[name=btnCategoria]").html("<i class=\"fa fa-spinner fa-spin\"></i> Por favor espere...").attr("disabled");

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "includes/process_categorias.php",
                data: $("form[name=FormCategorias]").serialize(),
                success: (response) => {
                    const { ok, message, data } = response
                    alert(message);

                    if (ok) {
                        $("button[name=btnCategoria]").html("<i class=\"fa fa-save\"></i> Guardar").removeAttr("disabled");
                        $("form[name=FormCategorias]")[0].reset();
                        $("#exampleModal").modal("hide")

                        var html = '';
                        html += '<option value="">Seleccione</option>';

                        $.each(data, (index, value) => { 
                            html += '<option value="'+value.id_categoria+'">'+value.categoria+'</option>'
                        });

                        $("#categoria").html(html);
                    }
                },
                error: () => {
                    console.error("Hubo un problema al insertar la categoria");
                }
            });
        });
    }
}