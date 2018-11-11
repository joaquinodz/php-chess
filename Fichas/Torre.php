<?php
class Torre {
	
	protected $_color;

	public function __construct($color) {
		$this->_color = $color;
	}

	public function getColor() {
		return $this->_color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
				return "img/torre-b.png";
				break;
			
			case 'negro':
				return "img/torre-n.png";
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

		// Si se mueve para adelante
		if ($from_x>$to_x && $from_y == $to_y) {
			$x= $from_x-1;
			$y= $from_y;
			return $x."-".$y;
		}

		// Si se mueve para atras
		if ($from_x<$to_x && $from_y == $to_y) {
			$x= $from_x+1;
			$y= $from_y;
			return $x."-".$y;
		}

		// Si se mueve para la izquierda
		if ($from_x == $to_x && $from_y > $to_y) {
			$x= $from_x;
			$y= $from_y-1;
			return $x."-".$y;
		}

		// Si se mueve para la izquierda
		if ($from_x == $to_x && $from_y < $to_y) {
			$x= $from_x;
			$y= $from_y+1;
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

		// Moverse SOLO en linea recta
		if ($to_y == $from_y || $to_x == $from_x) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
