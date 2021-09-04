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
