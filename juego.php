<?php 
ini_set('display_errors',1); 
require_once 'Ajedrez.php'; 

session_start();

		// Por si se rompe algo
if (isset($_GET['reset'])) {
	unset($_SESSION['ajedrez']);
	header("Location: juego.php");
}

if (!isset($_SESSION['ajedrez']) || $_SESSION['ajedrez'] == '' || isset($_POST['reiniciar'])) {
	$ajedrez = new Ajedrez();
} else {
	$ajedrez = $_SESSION['ajedrez'];
}

if (isset($_POST['PrevPos']) && isset($_POST['PostPos'])) {
	$result = $ajedrez->mover($_POST['PrevPos'],$_POST['PostPos']);
	$_SESSION['ajedrez'] = $ajedrez;
	echo json_encode($result);
	die();
}

$_SESSION['ajedrez'] = $ajedrez;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Ajedrez</title>
</head>

<?php echo $ajedrez->show(); ?>


<body>

	<form id="PosManager" action="" method="POST">
		<input type="hidden" id="PrevPos" name="PrevPos" readonly ></input><br /><br />
		<input type="hidden" id="PostPos" name="PostPos" readonly></input><br /><br />
	</form>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>

	$(document).ready(function() {

		// Cargar valores iniciales
		PrimeraPos = null
		SegundaPos = null
		Turno = "<?php echo $ajedrez->getTurno(); ?>"

		// Para fines de desarrollo
		console.log("Posición Inicial: "+PrimeraPos);
		console.log("Posición Inicial: "+SegundaPos); 

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
					url: 'juego.php',
					method: 'POST',
					data: {PrevPos: PrimeraPos,
						PostPos: SegundaPos},
						success: function(response) {
							
							var obj = jQuery.parseJSON( response );
							if(obj.jaque == true){
								alert('JAQUE');
							}
							if(obj.mensaje != ''){
								alert(obj.mensaje);
							}
							location.reload();
						}
					});
			}

		});
	});
</script>
</html>