<?php 

class Bootstrap
{
	public static function run(Request $peticion)
	{
		$controlador =$peticion->getControlador() . 'Controller';
		$rutaControlador = ROOT . 'controllers' . DS . $controlador . '.php';
		$metodo = $peticion->getMetodo();
		$argumentos = $peticion->getArgumentos();
		
		if ( is_readable($rutaControlador) ) {         //fichero existe y legible
			require_once $rutaControlador;

			$controlador = new $controlador;

			if ( is_callable(array($controlador, $metodo))) {  //variable puedan ser llamados como funcion
				$metodo = $peticion->getMetodo();
			} else {
				$metodo = 'index';
			}

			if ( isset($argumentos) ) {
				call_user_func_array(array($controlador, $metodo), $argumentos);
			} else {
				call_user_func($controlador, $metodo);
			}
		} else {
			throw new Exception('Controlador no valido..');
		}
	}
}


?>