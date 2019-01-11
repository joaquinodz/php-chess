<?php 
ini_set('display_errors',1); 
require_once 'Ajedrez.php'; 

session_start();

		// Por si se rompe algo
if (isset($_GET['reset'])) {
	unset($_SESSION['ajedrez']);
	header("Location: index.php");
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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>

<body style="background-image:url('/img/background.jpg')">
	<br />
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center" style="color: #41e8f4; font-family: Trebuchet MS,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Tahoma,sans-serif; ">Ajedrez Online</h1>
				<div class="alert alert-info" style="width: 11%;float: left;">Turno: <?php echo $ajedrez->getTurno(); ?></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $ajedrez->show(); ?>
			</div>
		</div>
		<br/>
		<div class="alert alert-info" id="errorMsj" style="width: auto; margin:0 auto;"></div>
	</div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="game.js"></script>
</html>