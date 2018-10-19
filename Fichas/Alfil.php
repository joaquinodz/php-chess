<?php

class Alfil implements Fichas {

	protected $_color;

	public function __construct($color) {
		$this->_color = $color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
			return "img/alfil-b.png";
			break;
			
			case 'negro':
			return "img/alfil-n.png";
			break;
		}
	}
}
?>
