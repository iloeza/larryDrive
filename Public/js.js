$(document).ready(function (e) {
	feather.replace()

	$("#subirArchivo").on('submit', (function (e) {
		e.preventDefault();
		$.ajax({
			url: "?c=archivo&a=SubirArchivo",
			type: "POST",
			data: new FormData(this),
			contentType: false,
			processData: false,
		})
			.done(function (data) {
				// view uploaded file.
				$('#subirArchivoModal').modal('hide');
				$("#subirArchivo")[0].reset();
				$("#data").load("?c=usuario&a=home #data");
			})
			.fail(function () {

			})
			.always(function () {
				//alert("Complete");
			});
	}));


	$("#crearDir").on('submit', (function (e) {
		var errmsg = $("#errmsg");
		e.preventDefault();
		$.ajax({
			url: "?c=archivo&a=crearDirectorio",
			type: "POST",
			data: $(this).serialize()
		})
			.done(function (data) {
				$('#crearDirModal').modal('hide');
				if (errmsg.hasClass('d-block')){
					errmsg.addClass('d-none');
				}
				$("#crearDir")[0].reset();
				$("#data").load("?c=usuario&a=home #data");

			})
			.fail(function (err) {
				errmsg.html("El directorio ya existe");
				errmsg.removeClass('d-none');
				errmsg.addClass('d-block');

			})
			.always(function () {
				//alert("Complete");
			});
	}));
});
$(document).on('click', '.getDir', (function (e) {

	var dir = $(this).text();
	var point = $(this).attr("point");
	e.preventDefault();
	$.ajax({

		url: "?c=archivo&a=actualizarRuta",
		type: "POST",
		data: {
			dir: dir,
			point: point
		}
	})
		.done(function (data) {
			// view uploaded file.
			$("#data").load("?c=usuario&a=home #data");
		})
		.fail(function () {
			alert("failed");
		})
		.always(function () {
			//alert("Complete");
		});
}));
