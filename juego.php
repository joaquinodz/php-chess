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
	ini_set('display_errors', On); 
	require 'Ajedrez.php'; 
	$ajedrez = new Ajedrez(); 
	$ajedrez->empezar(); 

	if (isset($_POST['submit'])) {
		$ajedrez->mover(new Peon('negro'),$_POST['PrevPos'],$_POST['PostPos']);
	}

	?>
	<br />
	<br />

	<form id="PosManager" action="" method="POST">

		<label for="PrevPos">¿ Qu&eacute; ficha  quer&eacute;s mover ?</label><br />
		<input type="text" id="PrevPos" name="PrevPos"></input><br /><br />
		<label for="PostPos">¿ A donde la quer&eacute;s mover ?</label><br />
		<input type="text" name="PostPos"></input><br /><br />
		<button name="submit" type="submit">Mover</button>
	</form>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script>
	$(document).ready(function() {	
		var ficha = $('input.pos').attr('src');

		$('#PosManager').submit(function(event) {
		});
	});
</script>
</html>