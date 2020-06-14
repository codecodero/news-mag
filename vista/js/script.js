
/*=============================================
BANNER
=============================================*/

$(".fade-slider").jdSlider({

	isSliding: false,
	isAuto: true,
	isLoop: true,
	isDrag: false,
	interval: 5000,
	isCursor: false,
	speed: 3000

});

var alturaBanner = $(".fade-slider").height();

$(".bannerEstatico").css({ "height": alturaBanner + "px" })


/*=============================================
ANIMACIONES SCROLL
=============================================*/

$(window).scroll(function () {

	var posY = window.pageYOffset;

	if (posY > alturaBanner) {

		$("header").css({ "background": "white" })

		$("header .logotipo").css({ "filter": "invert(100%)" })

		$(".fa-search, .fa-bars").css({ "color": "black" })

	} else {

		$("header").css({ "background": "rgba(0,0,0,.5)" })

		$("header .logotipo").css({ "filter": "invert(0%)" })

		$(".fa-search, .fa-bars").css({ "color": "white" })

	}

})

/*=============================================
MENÚ
=============================================*/

$(".fa-bars").click(function () {

	$(".menu").fadeIn("fast");

})

$(".btnClose").click(function (e) {

	e.preventDefault();

	$(".menu").fadeOut("fast");

})

/*=============================================
GRID CATEGORÍAS
=============================================*/

$(".grid figure, .gridFooter figure").mouseover(function () {

	$(this).css({ "background-position": "right bottom" })

})

$(".grid figure, .gridFooter figure").mouseout(function () {

	$(this).css({ "background-position": "left top" })

})

$(".grid figure, .gridFooter figure").click(function () {

	var vinculo = $(this).attr("vinculo");

	window.location = vinculo;

})

/*=============================================
PAGINACIÓN
=============================================*/

// $(".pagination").twbsPagination({
// 	totalPages: 10,
// 	visiblePages: 4,
// 	first: "Primero",
// 	last: "Último",
// 	prev: '<i class="fas fa-angle-left"></i>',
// 	next: '<i class="fas fa-angle-right"></i>'

// });


/*=============================================
SCROLL UP
=============================================*/

$.scrollUp({
	scrollText: "",
	scrollSpeed: 2000,
	easingType: "easeOutQuint"
})

/*=============================================
DESLIZADOR DE ARTÍCULOS
=============================================*/


$(".deslizadorArticulos").jdSlider({
	wrap: ".slide-inner",
	slideShow: 3,
	slideToScroll: 3,
	isLoop: true,
	responsive: [{
		viewSize: 320,
		settings: {
			slideShow: 1,
			slideToScroll: 1
		}

	}]

});

// subir foto opinion
$("#foto_comment").change(function (e) {
	$(".alert").remove();
	let imagen = this.files[0];
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
		$("#foto_comment").val("");
		$("#foto_comment").after("<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>No es Imagen!</strong> Archivo no admitido</div>");
		e.preventDefault();

	} else if (imagen['size'] > 2000000) {
		$("#foto_comment").val("");
		$("#foto_comment").after("<div class='alert alert-warning' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button><strong>Imagen Pesado!</strong> Imagen demaciado pesado. Max 2MB</div>");
		e.preventDefault();
	} else {
		let data_image = new FileReader;
		data_image.readAsDataURL(imagen);
		$(data_image).on("load", function (event) {
			let ruta_img = event.target.result;
			$(".img_comment").attr("src", ruta_img);
		});
	}
});
let url_host = "http://localhost/news-mag/";
$("#btn_search").click(function (e) {
	search_form(e);
});
let search_form = function (e) {
	let text_search = $("#search").val().toLowerCase();
	let expresion = /^[0-9a-zñÑáéíóú ]*$/;
	if (!expresion.test(text_search)) {
		$("#search").val("");
		e.preventDefault();
	} else {
		let evaluarBusqueda = text_search.replace(/[ñáéíóú ]/g, "_");

		if ($("#search").val() != "") {
			window.location = url_host + "search/" + evaluarBusqueda;
		} else {
			alert("Ingrese para buscar");
			e.preventDefault();
		}
	}
}

$(document).on("keyup", "#search", function (e) {
	if (e.keyCode == 13 && $("#search").val() != "") {
		search_form(e);
	}
	e.preventDefault();
});