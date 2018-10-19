<?php

class Peon {

	protected $_color;

	public function __construct($color) {
		$this->_color = $color;
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
}
?>
