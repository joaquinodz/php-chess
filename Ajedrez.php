<?php
require_once 'Tablero.php';
require_once 'Fichas/Alfil.php';
require_once 'Fichas/Caballo.php';
require_once 'Fichas/Peon.php';
require_once 'Fichas/Reina.php';
require_once 'Fichas/Rey.php';
require_once 'Fichas/Torre.php';

class Ajedrez{

	protected $_tablero;

	protected $_turno;

	public function __construct(){
		
		// Inicializo el Tablero
		$this->_tablero = new Tablero();

		$this->_turno = 'blanco';

		//Declaro las fichas negras
		$alfilN = new Alfil('negro');
		$caballoN = new Caballo('negro');
		$peonN = new Peon('negro');
		$reinaN = new Reina('negro');
		$reyN = new Rey('negro');
		$torreN = new Torre('negro');
		
		// Las coloco respectivamente
		$this->_tablero->ponerFicha($torreN,1,1);
		$this->_tablero->ponerFicha($caballoN,1,2);
		$this->_tablero->ponerFicha($alfilN,1,3);
		$this->_tablero->ponerFicha($reinaN,1,4);
		$this->_tablero->ponerFicha($reyN,1,5);
		$this->_tablero->ponerFicha($alfilN,1,6);
		$this->_tablero->ponerFicha($caballoN,1,7);
		$this->_tablero->ponerFicha($torreN,1,8);
		$this->_tablero->ponerFicha($peonN,2,1);
		$this->_tablero->ponerFicha($peonN,2,2);
		$this->_tablero->ponerFicha($peonN,2,3);
		$this->_tablero->ponerFicha($peonN,2,4);
		$this->_tablero->ponerFicha($peonN,2,5);
		$this->_tablero->ponerFicha($peonN,2,6);
		$this->_tablero->ponerFicha($peonN,2,7);
		$this->_tablero->ponerFicha($peonN,2,8);

		
		// Fichas Blancas
		$alfilB = new Alfil('blanco');
		$caballoB = new Caballo('blanco');
		$peonB = new Peon('blanco');
		$reinaB = new Reina('blanco');
		$reyB = new Rey('blanco');
		$torreB = new Torre('blanco');
		
		// Las coloco respectivamente
		$this->_tablero->ponerFicha($torreB,8,1);
		$this->_tablero->ponerFicha($caballoB,8,2);
		$this->_tablero->ponerFicha($alfilB,8,3);
		$this->_tablero->ponerFicha($reinaB,8,4);
		$this->_tablero->ponerFicha($reyB,8,5);
		$this->_tablero->ponerFicha($alfilB,8,6);
		$this->_tablero->ponerFicha($caballoB,8,7);
		$this->_tablero->ponerFicha($torreB,8,8);
		$this->_tablero->ponerFicha($peonB,7,1);
		$this->_tablero->ponerFicha($peonB,7,2);
		$this->_tablero->ponerFicha($peonB,7,3);
		$this->_tablero->ponerFicha($peonB,7,4);
		$this->_tablero->ponerFicha($peonB,7,5);
		$this->_tablero->ponerFicha($peonB,7,6);
		$this->_tablero->ponerFicha($peonB,7,7);
		$this->_tablero->ponerFicha($peonB,7,8);
		
	}

	public function empezar(){
		$this->_tablero->dibujar();
	}

	public function cambiarTurno() {
		switch ($this->_turno) {
			case 'blanco':
				$this->_turno = 'negro';
				break;
			
			case 'negro':
				$this->_turno = 'blanco';
				break;
		}
	}

	public function mover($Previous,$Posterior) {
		$pos_anterior = explode("-", $Previous);
		$pos_posterior = explode("-", $Posterior);

		$ficha = $this->_tablero->obtenerFicha($pos_anterior[0],$pos_anterior[1]);

		if ($ficha->getColor() == $this->_turno) {
			if ($ficha->puedeMover($Previous,$Posterior)) {
				$this->_tablero->ponerFicha('',$pos_anterior[0],$pos_anterior[1]);
				$this->_tablero->ponerFicha($ficha,$pos_posterior[0],$pos_posterior[1]);
				$this->cambiarTurno();
			}
		}
		echo $ficha::closestPos($Previous,$Posterior);
	}

	public function show() {
		return $this->_tablero->dibujar();
	}
}

