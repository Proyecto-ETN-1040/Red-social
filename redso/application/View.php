<?php 

class View
{
	private $_controlador;

	public function __construct(Request $peticion)
	{
		$this->_controlador = $peticion->getControlador();
		Session::Set('_controlador', $this->_controlador);
	}

	public function render($vista, $item = false)
	{
		if ( !Session::get('login_redso') ) {
			header('Location: ' . BASE_URL . 'usuarios/login');
			exit;
		}

		$_assets = array(
			'css'		=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//css/',
			'js'		=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//js/',
			'img'		=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//img/',
			'images'	=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//images/',
			'plugins'	=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//plugins/',
		);

		$rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';

		if ( is_readable($rutaView) ) {
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
			include_once $rutaView;
			include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
		} else {
			throw new Exception('Vista no valida...');
		}
	}

	public function render_login($vista, $item = false)
	{
		$_assets = array(
			'css'		=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//css/',
			'js'		=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//js/',
			'img'		=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//img/',
			'plugins'	=>		BASE_URL . 'views/layout/' . DEFAULT_LAYOUT . '//plugins/',
		);

		$rutaView = ROOT . 'views' . DS . $this->_controlador . DS . $vista . '.phtml';

		if ( is_readable($rutaView) ) {
			// include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'header.php';
			include_once $rutaView;
			// include_once ROOT . 'views' . DS . 'layout' . DS . DEFAULT_LAYOUT . DS . 'footer.php';
		} else {
			throw new Exception('Vista no valida...');
		}
	}
}

?>