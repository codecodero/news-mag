$(document).ready(function () {
    let redes_socials = JSON.parse($("#redes_sociales").val());
    $(document).on("click", "#btn_add_red", function (e) {
        let url = $("#link_red").val();
        let icono = $("#icono_redes").val();

        if (url != "" && icono != 0) {
            $("#socials").append(
                '<div class="input-group mb-3"><div class= "input-group-prepend" ><span class="input-group-text"><i class="' +
                    icono +
                    '"></i></span></div><input type="text" class="form-control" placeholder="" value="' +
                    url +
                    '"><div class="input-group-append"><span class="btn btn-danger eliminar_red" data-url="' +
                    url +
                    '">&times;</span></div></div>'
            );
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
    $(document).on("click", ".eliminar_red", function () {
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

    $("input[type='file']").change(function () {
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
            $(img_prev).on("load", function (e) {
                let src_img = e.target.result;
                $(".img_" + nombreimg).attr("src", src_img);
            });
        }
    });
});
