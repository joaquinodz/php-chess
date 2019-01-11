$(document).ready(function() {

	// Esta es la version JavaScript de $_SESSION[] (PHP)
	// En este caso, verifico si soporta esta API
	if (typeof(Storage) !== "undefined") {
		// Declaro una variable inicial
		sessionStorage.Tema = 'default';
	} else {
		alert("Tu navegador no soporta la API de Almacenamiento Local caracteristica de HTML5. Por favor, actualizá tu navegador.");
	}
		
	// Si se elige el tema por-defecto, ni me molesto en hacer el loop
	if (sessionStorage != 'default') {
		// Cambio el estilo de las fichas
		$("img.ficha").each(function() {
			var source = $(this).attr('src').split("/");
			$(this).attr('src', ''+source[0]+'/'+sessionStorage.Tema+'/'+source[2]+'');
		});
	}
		
	// Cargar valores iniciales
	PrimeraPos = null
	SegundaPos = null
	Turno = "<?php echo $ajedrez->getTurno(); ?>"

	$("#tablero").click(function(event) {
		event.preventDefault();

		console.log("Estas cliqueando: "+event.target.id);

		if (PrimeraPos == null) {
			// Compruebo que sea su turno
			var Ficha = event.target.id.split("-");
			if (Ficha[2] != Turno) { return false; }
				
			// Guardo la pos
			PrimeraPos = event.target.id;
			console.log("Posición Inicial: " + PrimeraPos);
		} else {
			SegundaPos = event.target.id;
			console.log("Posición Destino: " + SegundaPos);
		}

		if (PrimeraPos != null && SegundaPos != null) {
			// Enviamos los datos vía AJAX
			$.ajax({
				url: 'index.php',
				method: 'POST',
				data: {
					PrevPos: PrimeraPos,
					PostPos: SegundaPos},
					success: function(response) {
						var obj = jQuery.parseJSON( response );
						if(obj.jaque == true){
							alert('JAQUE');
						}
						if(obj.mensaje != "") {
							console.log(obj.mensaje);
							alert(obj.mensaje);
						}

						location.reload();
					}
				});
			}
		});
	});