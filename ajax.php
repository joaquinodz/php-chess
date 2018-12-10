<?php

if (isset($_POST['PrevPos']) && isset($_POST['PostPos'])) {
	$PosInicial = $_POST['PrevPos'];
	$PosDestino = $_POST['PostPos'];

	echo ("Éxito! Posiciones Recibidas: " . $PosInicial . " -> ". $PosDestino);
} else {
	echo ("¡¡¡Error!!!! Posiciones Recibidas: " . $PosInicial ." -> " . $PosDestino);
}
