<?php

class Reina {

	protected $_color;

	public function __construct($color) {
		$this->_color = $color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
				return "img/reina-b.png";
				break;
			
			case 'negro':
				return "img/reina-n.png";
				break;
		}
	}
}
?>
