<?php

class Peon {

	protected $_color;

	public $estilo;

	public function __construct($color) {
		$this->_color = $color;
	}

	public function __toString() {
        return "Peon";
    }

	public function getColor() {
		return $this->_color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
				return "img/peon-b.png";
			break;
			
			case 'negro':
				return "img/peon-n.png";
			break;
		}
	}

	// Devuelve la posición mas cercana permitida para la ficha con su respectivo color
	public static function closestPos($desde,$hasta) {
		$Desde = explode('-', $desde);
		$Hasta = explode('-', $hasta);

		$from_x = $Desde[0];
		$from_y = $Desde[1];
		$to_x = $Hasta[0];
		$to_y = $Hasta[1];

		// Si es blanca
		if ($from_x>$to_x && $from_y == $to_y) {
			$x= $from_x-1;
			$y= $from_y;
			return $x."-".$y;
		} 

		// Si es negra
		if ($from_x<$to_x && $from_y == $to_y) {
			$x= $from_x+1;
			$y= $from_y;
			return $x."-".$y;
		}
	}

	public function puedeMover($From,$To) {
		$Desde = explode('-', $From);
		$Hasta = explode('-', $To);

		$from_x = $Desde[0];
		$from_y = $Desde[1];
		$to_x = $Hasta[0];
		$to_y = $Hasta[1];

		if (($from_x == $to_x-1 || $from_x == $to_x+1) && $from_y == $to_y) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
