jQuery(document).ready(function($) {
    // $.ajax({
    //     url: url_host + "/news-mag/cms/public/banner",
    //     success: function(respuesta) {
    //         console.log("Success:", respuesta);
    //     },
    //     error: function(jqXHR, textStatus, errorThown) {
    //         console.log("Error en: " + errorThown);
    //     },
    // });
    let tabla_banner = $("#tabla_banner").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: url_host + "/news-mag/cms/public/banner",
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
            data: "id_banner",
            name: "id_banner",
        }, {
            data: "titulo_banner",
            name: "titulo_banner",
        }, {
            data: "descripcion_banner",
            name: "descripcion_banner",
        }, {
            data: "img_banner",
            name: "img_banner",
            render: function(data, type, full, meta) {
                if (data == null) {
                    return `<img width="400" class="img-thumbnail" src="${url_host}/news-mag/cms/public/img/admin/default.png" >`;
                } else {
                    return `<img width="400" class="img-thumbnail" src="${url_host}/news-mag/cms/public/${data}" >`;
                }
            },
            orderable: false,
        }, {
            data: "pagina_banner",
            name: "pagina_banner",
        }, {
            data: "fecha_banner",
            name: "fecha_banner",
        }, {
            data: "acciones",
            name: "acciones",
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
    tabla_banner.on("order.dt search.dt", function() {
        tabla_banner.column(0, {
            search: "applied",
            order: "applied",
        }).nodes().each(function(cell, i) {
            cell.innerHTML = +i + 1;
        });
    }).draw();
    $(document).on("click", ".btn-eliminar-banner", function(e) {
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
                            tabla_banner.on("order.dt search.dt", function() {
                                tabla_banner.column(0, {
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