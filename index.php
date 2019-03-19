<?php 
ini_set('display_errors',1); 
require_once 'Ajedrez.php'; 

session_start();

// Por si se rompe algo
if (isset($_GET['reset'])) {
	unset($_SESSION['ajedrez']);
	header("Location: index.php");
}

if (!isset($_SESSION['ajedrez']) || $_SESSION['ajedrez'] == '') {
	$ajedrez = new Ajedrez();
	//$_SESSION['rollback'] =  $ajedrez;
} elseif (isset($_POST['undo'])) {
	$ajedrez = $_SESSION['rollback'];
} else {
	$ajedrez = $_SESSION['ajedrez'];
}

if (isset($_POST['PrevPos']) && isset($_POST['PostPos'])) {

	$_SESSION['rollback'] = $ajedrez;

	// Muevo la ficha.
	$result = $ajedrez->mover($_POST['PrevPos'],$_POST['PostPos']);
	$_SESSION['ajedrez'] = $ajedrez;
	echo json_encode($result);
	die();
}

$_SESSION['ajedrez'] = $ajedrez;
echo "<pre>";
print_r($_SESSION['rollback']);
echo "</pre>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Ajedrez</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>

<body style="background-image:url('img/background.png')">
	<br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="alert alert-info" style="width: 11%;float: left;">Turno: <?php echo $ajedrez->getTurno(); ?></div>
			</div>
			<div class="col-md-4">
				<h1 class="text-center" style="color: #41e8f4; font-family: Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif; ">Ajedrez Online</h1>
				
			</div>
			<div class="col-md-4">
				<?php include 'settings.php'; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $ajedrez->show(); ?>
			</div>
		</div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function() {

	// Esta es la version JavaScript de $_SESSION[] (PHP)
	// En este caso, verifico si soporta esta API
	if (typeof(Storage) !== "undefined") {
		if (typeof(sessionStorage.Tema) == "undefined") {
			// Declaro una variable inicial
			sessionStorage.Tema = 'Default';
			console.log(sessionStorage.Tema)
		} else { 
			console.log("Tema Actual: " + sessionStorage.Tema)
		}
	} else {
		alert("Tu navegador no soporta la API de Almacenamiento Local caracteristica de HTML5. Por favor, actualizá tu navegador.");
	}

	// Si se elige el tema por-defecto, ni me molesto en hacer el loop
	if (sessionStorage.Tema != 'Default') {
		// Cambio el estilo de las fichas
		$("img.ficha").each(function() {
			var source = $(this).attr('src').split("/");
			$(this).attr('src', ''+source[0]+'/'+sessionStorage.Tema+'/'+source[2]+'');
		});
	}

	// Cargamos la lista de temas disponibles.
	$.getJSON( "img/list_themes.php", function( data ) {
		var Temas = data.Temas_Disponibles.split("-")

		$.each(Temas, function(index, val) {
			console.log("Tema Disponible: " + val)
			$("#styles").append("<option id='" + val + "'>" + val + "</option>");
		});

		$("#styles").val(sessionStorage.Tema)
	});

	// Seteamos el tema.
	$("#styles").change(function(event) {
		event.preventDefault();

		sessionStorage.Tema = $("#styles").val()
		location.href = document.location
	});

	// Botón reiniciar partida.
	$("#resetGame").click(function(event) {
		location.href = document.location  + "?reset"
	});


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
			if (Ficha[2] != Turno) { 
				alert("¡Esperá a que sea tu turno!")
				return false; 
			}

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
				data: { PrevPos: PrimeraPos, 
					PostPos: SegundaPos },
					success: function(response) {
						var obj = jQuery.parseJSON( response );
						if(obj.jaque == true){
							alert('¡JAQUE!');
						}
						if (obj.mensaje == '') {} else { alert(obj.mensaje); }
						location.reload();
					}
				});
		}
	});
});
</script>
</html>