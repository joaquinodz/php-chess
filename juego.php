<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Ajedrez</title>
</head>
<body>
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

		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
		{
			require_once 'ajax.php';
			$ajedrez->mover($PosInicial,$PosDestino);
		}
		
		$_SESSION['ajedrez'] = $ajedrez;
	?>
	<br />
	<br />

	<?php echo $ajedrez->show(); ?>

	<form id="PosManager" action="" method="POST">

		<label for="PrevPos">¿ Qu&eacute; ficha  quer&eacute;s mover ?</label><br />
		<input type="text" id="PrevPos" name="PrevPos" readonly ></input><br /><br />
		<label for="PostPos">¿ A donde la quer&eacute;s mover ?</label><br />
		<input type="text" id="PostPos" name="PostPos" readonly></input><br /><br />
		<button name="submit" id="mover" type="submit">Mover</button>
		<button name="reiniciar" id="reiniciar" type="submit">Reset</button>
	</form>


</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>

	$(document).ready(function() {

		// Cargar valores iniciales
		PrimeraPos = null
		SegundaPos = null

		// Para fines de desarrollo
		console.log("Posición Inicial: "+PrimeraPos);
		console.log("Posición Inicial: "+SegundaPos);

		$("#tablero").click(function(event) {
			event.preventDefault();

			if (PrimeraPos == null) {
				PrimeraPos = event.target.id;
				console.log("Posición Inicial: " + PrimeraPos);
			} else {
				SegundaPos = event.target.id;
				console.log("Posición Destino: " + SegundaPos);
			}

			if (PrimeraPos != null && SegundaPos != null) {
				// Enviamos los datos vía AJAX
				$.ajax({
					url: 'ajax.php',
					method: 'POST',
					data: {PrevPos: PrimeraPos,
							PostPos: SegundaPos},
					success: function(response) {
						console.log(response);
					}
				});
				
			}

		});
	});
</script>
</html>