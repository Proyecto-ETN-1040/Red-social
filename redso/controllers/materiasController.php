<?php 

class materiasController extends Controller
{
	private $materia;

	public function __construct()
	{
		parent::__construct();
		$this->materia = $this->loadModel('materia');
	}
	
	public function adm_materia()
	{
		$id = $this->getInt('id');
		
		if ($this->getInt('id') > 0) {
			$datos = array(
				':des'		=>	$this->getText('des'),
				':detalle'	=>	$this->getText('detalle'),
				':estado'	=>	$this->getText('estado'),
			);
			//if ( strlen($this->getText('contrasena')) > 0 ) {
			$res = $this->materia->actualizarMateriasAdm($id, $datos);			
		} else {
			$datos = array(
				':des'		=>	$this->getText('des'),
				':detalle'	=>	$this->getText('detalle'),
				':estado'	=>	$this->getText('estado'),
			);
			$res = $this->materia->agregarMateriasAdm($datos);
			//$res1 = $this->usuario->agregarUsuarioAdm($datos);
		}

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	BASE_URL . 'admin/materias',
		));
	}


	public function datos_materia($id)
	{
		$id = (int) $id;
		echo json_encode($this->materia->getMateria($id));
	}

	public function borrar()
	{
		$id = $this->getInt('id');
		$res = $this->materia->borrarMateria($id);
		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
		));
	}

}
?>
