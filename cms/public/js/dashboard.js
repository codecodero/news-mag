    let url_host = document.location.origin;
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
    $(document).ready(function() {
        $(".summernote").summernote({
            height: 150,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            callbacks: {
                onImageUpload: function(files) {
                    for (let i = 0; i < files.length; i++) {
                        SubirImagen(files[i]);
                    }
                },
            },
        });
        let SubirImagen = function(imagenes) {
            let datos = new FormData();
            datos.append("img", imagenes, imagenes.name);
            datos.append("ruta", url_host);
            $.ajax({
                    url: url_host + "/news-mag/cms/public/ajax/subir_img.php",
                    method: "POST",
                    data: datos,
                    contentType: false,
                    cache: false,
                    processData: false,
                }) // optional, default = 'Yes'
                .done(function(respuesta) {
                    $(".summernote").summernote("insertImage", respuesta);
                    console.log("success");
                }).fail(function(jqXHR, textStatus, errorThown) {
                    console.log("error" + errorThown);
                }).always(function() {
                    console.log("complete");
                });
        };
        $(document).on("click", "#btn_add_red", function(e) {
            let redes_socials = JSON.parse($("#redes_sociales").val());
            let url = $("#link_red").val();
            let icono = $("#icono_redes").val();
            if (url != "" && icono != 0) {
                $("#socials").append('<div class="input-group mb-3"><div class= "input-group-prepend" ><span class="input-group-text"><i class="' + icono + '"></i></span></div><input type="text" class="form-control" placeholder="" value="' + url + '"><div class="input-group-append"><span class="btn btn-danger eliminar_red" data-url="' + url + '">&times;</span></div></div>');
                redes_socials.push({
                    url: url,
                    icono: icono,
                });
                $("#redes_sociales").val(JSON.stringify(redes_socials));
                $("#link_red").val("");
                $("#icono_redes").val(0);
            } else {
                notie.alert({
                    type: 2,
                    text: "Ingrese un red social valido",
                    time: 7,
                });
            }
            e.preventDefault();
        });
        $(document).on("click", ".eliminar_red", function() {
            let redes_socials = JSON.parse($("#redes_sociales").val());
            let url_red = $(this).attr("data-url");
            for (let i = 0; i < redes_socials.length; i++) {
                if (url_red == redes_socials[i]["url"]) {
                    redes_socials.splice(i, 1);
                    $(this).parent().parent().remove();
                    $("#redes_sociales").val(JSON.stringify(redes_socials));
                    break;
                }
            }
        });
        $("input[type='file']").change(function() {
            let img = this.files[0];
            let nombreimg = $(this).attr("id");
            if (img["type"] != "image/jpeg" && img["type"] != "image/png") {
                $("input#inoco").val("");
                notie.alert({
                    type: 2,
                    text: "No es una imagen",
                    time: 7,
                });
            } else if (img["size"] > 2000000) {
                $("input#inoco").val("");
                notie.alert({
                    type: 2,
                    text: "Imagen demaciado pesado, Max 2MB",
                    time: 7,
                });
            } else {
                let img_prev = new FileReader();
                img_prev.readAsDataURL(img);
                $(img_prev).on("load", function(e) {
                    let src_img = e.target.result;
                    $(".img_" + nombreimg).attr("src", src_img);
                });
            }
        });
        //Creando Cookie
        let crear_cookie = function(nombre_cookie, valor, dias_expired) {
            let hoy = new Date();
            hoy.setTime(hoy.getTime() + (dias_expired * 24 * 60 * 60 * 1000));
            let fecha_expired = "expires=" + hoy.toUTCString();
            document.cookie = nombre_cookie + '=' + valor + "; " + fecha_expired;
        };
        $(document).on('change', '.email_login', function() {
            crear_cookie('email_login', $(this).val(), 1);
        });
    });