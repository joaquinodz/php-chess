<?php

class Caballo {

	protected $_color;

	public function __construct($color) {
		$this->_color = $color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
				return "img/caballo-b.png";
				break;
			
			case 'negro':
				return "img/caballo-n.png";
				break;
		}
	}
}
?>
