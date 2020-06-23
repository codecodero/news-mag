$(document).ready(function() {
    // $.ajax({
    //     url: url_host + "/news-mag/cms/public/categorias",
    //     success: function(respuesta) {
    //         console.log("Success:", respuesta);
    //     },
    //     error: function(jqXHR, textStatus, errorThown) {
    //         console.log("Error en: " + errorThown);
    //     },
    // });
    let tabla_category = $("#tabla_categorias").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url_host + "/news-mag/cms/public/categorias",
        },
        columnDefs: [{
            searchable: true,
            orderable: true,
            targets: 0,
        }, ],
        order: [
            [0, "desc"]
        ],
        columns: [{
            data: "id",
            name: "id",
        }, {
            data: "categoria",
            name: "categoria",
        }, {
            data: "descripcion",
            name: "descripcion",
        }, {
            data: "palabras_claves",
            name: "palabras_claves",
        }, {
            data: "ruta",
            name: "ruta",
            render: function(data, type, full, meta) {
                return '<div class="validar_ruta">' + data + '</div>';
            }
        }, {
            data: "img",
            name: "img",
            render: function(data, type, full, meta) {
                if (data == null) {
                    return `<img width="100px" class="" src="${url_host}/news-mag/cms/public/img/categorias/default.png" >`;
                } else {
                    return `<img width="100px" class="" src="${url_host}/news-mag/cms/public/${data}" >`;
                }
            },
            orderable: false,
        }, {
            data: "created_at",
            name: "created_at"
        }, {
            data: "acciones",
            name: "acciones"
        }],
        language: {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: "No se encontraron resultados",
            sEmptyTable: "Ningún dato disponible en esta tabla",
            sInfo: "Mostrando registros del _START_ al _END_",
            sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sInfoPostFix: "",
            sSearch: "Buscar:",
            sUrl: "",
            sInfoThousands: ",",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            oAria: {
                sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                sSortDescending: ": Activar para ordenar la columna de manera descendente",
            },
        },
    });
    tabla_category.on("order.dt search.dt", function() {
        tabla_category.column(0, {
            search: "applied",
            order: "applied",
        }).nodes().each(function(cell, i) {
            cell.innerHTML = +i + 1;
        });
    }).draw();
    $(document).on("keyup", ".ruta", function() {
        let ruta_cat = $(this).val().toLocaleLowerCase();
        ruta_cat = ruta_cat.replace(/ /g, "-");
        ruta_cat = ruta_cat.replace(/[á]/g, 'a');
        ruta_cat = ruta_cat.replace(/[é]/g, 'e');
        ruta_cat = ruta_cat.replace(/[í]/g, 'i');
        ruta_cat = ruta_cat.replace(/[ó]/g, 'o');
        ruta_cat = ruta_cat.replace(/[ú]/g, 'u');
        ruta_cat = ruta_cat.replace(/[ñ]/g, 'n');
        $(".ruta").val(ruta_cat);
        let valor_ruta = $(this).val();
        let validar_ruta = $(".validar_ruta");
        for (let i = 0; i < validar_ruta.length; i++) {
            if ($(validar_ruta[i]).html() == valor_ruta) {
                $(".ruta").val("");
                notie.alert({
                    type: 3,
                    text: '<h4><b>Error con la Ruta</b></h4> Ya existe la ruta en la base de datos, elija otro',
                    time: 7
                });
                $(".ruta").focus();
            }
        }
    });
    $(document).on("click", ".btn-eliminar-cat", function(e) {
        let method = "DELETE",
            action = $(this).attr("data-action"),
            // token = $(this).children("[name='_token']").attr("value");
            token = $(this).attr("data-token");
        let padre = $(this).parent().parent();
        notie.confirm({
            text: "¿Esta seguro de eliminar este Registro?",
            submitText: "Si, eliminar",
            cancelText: "Cancelar",
            submitCallback: function() {
                let datos = new FormData();
                datos.append("_method", method);
                datos.append("_token", token);
                $.ajax({
                    url: action,
                    method: "POST",
                    data: datos,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta) {
                        if (respuesta == "ok") {
                            notie.alert({
                                type: 1,
                                text: "Eliminado correctamente",
                                time: 7,
                            });
                            padre.remove();
                            tabla_category.on("order.dt search.dt", function() {
                                tabla_category.column(0, {
                                    search: "applied",
                                    order: "applied",
                                }).nodes().each(function(cell, i) {
                                    cell.innerHTML = +i + 1;
                                });
                            }).draw();
                        } else {
                            notie.alert({
                                type: 3,
                                text: "Error al intentar eliminar a un Admin",
                                time: 7,
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log("Error en: " + errorThrown);
                    },
                });
            },
            cancelCallback: function() {
                e.preventDefault();
            },
        });
    });
});