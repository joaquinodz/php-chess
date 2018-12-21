<?php

class Tablero{

	protected $_matriz;

	public function __construct(){

		#ver como crear un array de 8 ints consecutivos
		$this->_matriz = array_fill(1, 8, "");
		for($i=1;$i<=8;$i++){
			$this->_matriz[$i] = array_fill(1, 8, "");
		}
	}

	public function ponerFicha($ficha,$fila,$columna){

		if (is_null($ficha)) {
			unset($this->_matriz[$fila][$columna]);
		} else {
			$this->_matriz[$fila][$columna] = $ficha;
			$_SESSION['SavedGame'] = $this->_matriz;
		}
	}

	public function obtenerFicha($fila,$columna) {
		return $this->_matriz[$fila][$columna];
	}

	public function dibujar() {
		echo "<table id='tablero' class='main' border=1 style='margin: 0 auto;'>";
		
		// Renderizo las filas de las tablas
		for($fila=1;$fila<=8;$fila++){
			echo "<tr class='fila' name='f".$fila."' id='f".$fila."' >";
			
			// Renderizo las columnas
			for($columna=1;$columna<=8;$columna++){
				echo "<td class='celda' name='c".$columna."' id='c".$columna."'>";
				 if($this->_matriz[$fila][$columna] == ''){
					echo "<img id='".$fila."-".$columna."' src='img/blanco.png'/>";
				} else {
					echo "<img id='".$fila."-".$columna."-".$this->_matriz[$fila][$columna]->getColor()."' src='".$this->_matriz[$fila][$columna]->dibujarFicha()."' />";
				}
				echo '</td>';
			}
			echo '</tr>';
		}
		echo '</table>';
	}

	public function getMatriz() {
		echo json_encode($this->_matriz);
	}

	public function checkFichas($ficha,$Prev,$Next) {
		// Esta es la proxima posicion disponible para moverse
		$posActual = $ficha::closestPos($Prev,$Next);
		$return = TRUE;
		while ($posActual != $Next) {

			$pos = explode('-', $posActual);

			if ($this->obtenerFicha($pos[0],$pos[1]) != '') {
				$return = FALSE;
				break;
			}

			$posActual = $ficha::closestPos($posActual,$Next);
			
		}

		return $return;
	}

	public function obtenerAllFichas($color) {
		$result = array();
		// Renderizo las filas de las tablas
		for($fila=1;$fila<=8;$fila++){
		
			// Renderizo las columnas
			for($columna=1;$columna<=8;$columna++){
				$ficha= $this->obtenerFicha($fila,$columna);
				
				if ($ficha != '' && $ficha->getColor() == $color) {
					$result[] = array('ficha'=>$ficha,'pos'=>$fila.'-'.$columna);
				}
			}
		}
		return $result;
	}

}
