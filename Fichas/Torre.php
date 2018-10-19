<?php
class Torre {
	
	protected $_color;


	public function __construct($color) {
		$this->_color = $color;
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
}
?>
