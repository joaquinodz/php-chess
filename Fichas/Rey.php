<?php

class Rey {
	
	protected $_color;

	public function __construct($color) {
		$this->_color = $color;
	}

	public function dibujarFicha() {
		switch ($this->_color) {
			case 'blanco':
				return "img/rey-b.png";
				break;
			
			case 'negro':
				return "img/rey-n.png";
				break;
		}
	}
}
?>
