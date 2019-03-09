<?php


// Array en el que obtendremos los resultados
$res = array();

// Creamos un puntero al directorio actual y obtenemos el listado de archivos
$dir = @dir(__DIR__) or die("Error abriendo el directorio actual");
while(($archivo = $dir->read()) !== false) {
    // Obviamos los archivos ocultos y los que NO son directorios
	if($archivo[0] == "." || is_dir($archivo) == FALSE) continue;
	if(!isset($res['Temas_Disponibles'])) {
		$res['Temas_Disponibles'] = $archivo;
	} else {
		$res['Temas_Disponibles'] = $res['Temas_Disponibles'] . "-" . $archivo; 
	}
}
$dir->close();

// Lo preparo para que lo agarre el AJAX
echo json_encode($res);