// Subiendo la foto del usuario

$('.nuevaFoto').change(function () {
	var imagen = this.files[0];

	// Validamos el formato de la imagen sea JPG O Png
	if (imagen['type'] != 'image/jpeg' && imagen['type'] != 'image/png') {
		$('.nuevaFoto').val('');

		swal({
			type: 'Error al subir la imagen',
			title: '¡La imagen debe estar en formato JPG o PNG!',
			type: 'error',
			confirmButtonText: '¡Cerrar!',
		});
	} else if (imagen['size'] > 2000000) {
		$('.nuevaFoto').val('');

		swal({
			type: 'Error al subir la imagen',
			title: '¡La imagen no debe pesar más de 2MB!',
			type: 'error',
			confirmButtonText: '¡Cerrar!',
		});
	} else {
		var datosImagen = new FileReader();
		datosImagen.readAsDataURL(imagen);

		$(datosImagen).on('load', function (event) {
			var rutaImagen = event.target.result;

			$('.previsualizar').attr('src', rutaImagen);
		});
	}
});

// Editar Usuario

$('.btnEditarUsuario').click(function () {
	var idUsuario = $(this).attr('idUsuario');

	var datos = new FormData();
	datos.append('idUsuario', idUsuario);

	//ajax para traer datos de la bd
	$.ajax({
		url: 'ajax/usuarios_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function (respuesta) {
			console.log('respuesta', respuesta);
			$('#editarNombre').val(respuesta['nombre']);
			$('#editarUsuario').val(respuesta['usuario']);

			$('#editarPerfil').html(respuesta['perfil']);
			$('#editarPerfil').val(respuesta['perfil']);
			// para mantener el password que tiene actual
			$('#passwordActual').val(respuesta['password']);

			// para mantener foto que tiene actual
			$('#fotoActual').val(respuesta['foto']);

			if (respuesta['foto'] != '') {
				$('.previsualizar').attr('src', respuesta['foto']);
			}
		},
	});
});
