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

// Activar Usuario

$('.btnActivar').click(function () {
	var idUsuario = $(this).attr('idUsuario');
	var estadoUsuario = $(this).attr('estadoUsuario');

	var datos = new FormData();
	datos.append('activarId', idUsuario);
	datos.append('activarUsuario', estadoUsuario);

	$.ajax({
		url: 'ajax/usuarios_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function (respuesta) {},
	});

	if (estadoUsuario == 0) {
		$(this).removeClass('btn-success');
		$(this).addClass('btn-danger');
		$(this).html('Desactivado');
		$(this).attr('estadoUsuario', 1);
	} else {
		$(this).addClass('btn-success');
		$(this).removeClass('btn-danger');
		$(this).html('Activado');
		$(this).attr('estadoUsuario', 0);
	}
});

// Revisar si el Usuario ya esta registrado
$('#nuevoUsuario').change(function () {
	$('.alert').remove();

	var usuario = $(this).val();

	var datos = new FormData();
	datos.append('validarUsuario', usuario);

	$.ajax({
		url: 'ajax/usuarios_ajax.php',
		method: 'POST',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function (respuesta) {
			if (respuesta) {
				$('#nuevoUsuario')
					.parent()
					.after(
						'<div class="alert alert-warning">Este usuario ya existe en la base de datos</div>'
					);

				$('#nuevoUsuario').val('');
			}
		},
	});
});
