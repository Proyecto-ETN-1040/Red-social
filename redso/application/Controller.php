<?php 

abstract class Controller
{

	protected $view;

	public function __construct()
	{
		$this->view = new View(new Request);
	}

	protected function loadModel($model)
	{
		$model = $model . 'Model';
		$rutaModelo = ROOT . 'models' . DS . $model . '.php';

		if ( is_readable($rutaModelo) ) {
			require_once $rutaModelo;
			$model = new $model;
			return $model;
		} else {
			throw new Exception('Modelo no encontrado');
		}
	}

	protected function loadLibrary($library)
	{
		$rutaLibrary = ROOT . 'libs' . DS . $library . '.php';

		if ( is_readable($rutaLibrary) ) {
			require_once $rutaLibrary;
		} else {
			throw new Exception('Libreria no encontrada');
		}
	}

	public function getText($key)
	{
		if ( isset($_POST[$key]) && !empty($_POST[$key]) ) {
			$_POST[$key] = htmlspecialchars($_POST[$key], ENT_QUOTES);
			return $_POST[$key];
		}

		return '';
	}

	public function getInt($key)
	{
		if ( isset($_POST[$key]) && !empty($_POST[$key]) ) {
			$_POST[$key] = filter_input(INPUT_POST, $key, FILTER_VALIDATE_INT);
			return $_POST[$key];
		}

		return 0;

	}

	public function getFloat($key)
	{
		if ( isset($_POST[$key]) && !empty($_POST[$key]) ) {
			$_POST[$key] = filter_input(INPUT_POST, $key, FILTER_VALIDATE_FLOAT);
			return $_POST[$key];
		}

		return 0;

	}

	public function redirect($ruta)
	{
		if ( $ruta ) {
			header('Location: ' . BASE_URL . $ruta);
			exit;
		} else {
			header('Location: ' . BASE_URL);
			exit;
		}
	}

}

?>