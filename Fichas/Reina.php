<?php

class Reina {

	protected $_color;

	public $estilo;

	public function __construct($color,$estilo) {
		$this->_color = $color;
		$this->estilo = $estilo;
	}
	
	public function __toString() {
        return "Reina";
	}

	public function getColor() {
		return $this->_color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
				return "img/".$this->estilo."/reina-b.png";
				break;
			
			case 'negro':
				return "img/".$this->estilo."/reina-n.png";
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

		// Se mueve en diagonal [SE]
		if ($from_x<$to_x && $from_y<$to_y) {
			$x= $from_x+1;
			$y= $from_y+1;
			return $x."-".$y;
		// Se mueve en diagonal [SO]
		} elseif ($from_x<$to_x && $from_y>$to_y) {
			$x= $from_x+1;
			$y= $from_y-1;
			return $x."-".$y;
		// Se mueve en diagonal [NE]
		} elseif ($from_x>$to_x && $from_y<$to_y) {
			$x= $from_x-1;
			$y= $from_y+1;
			return $x."-".$y;
		// Se mueve en diagonal [NO]
		} elseif ($from_x>$to_x && $from_y>$to_y) {
			$x= $from_x-1;
			$y= $from_y-1;
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

		// TODO: Agregar mas restricciones
		// Aparte del movimiento del caballo, puede hacer todos los demás (movimientos)
		if (($to_x == $from_x+2 || $to_x == $from_x-2) && ($to_y == $from_y+1 || $to_y == $from_y-1)) {
			return FALSE;
		} else {
			return TRUE;
		}

	}
}
?>
