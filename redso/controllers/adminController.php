<?php 

class adminController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->publicacion = $this->loadModel('publicaciones');
		$this->publi = $this->loadModel('publicacion');
		$this->usuario = $this->loadModel('usuario');
		$this->materia = $this->loadModel('materia');
	}

	public function index()
	{
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->titulo = 'Administrador de Contenidos';
		$this->view->usuarios = $this->usuario->listarUsuarios();
		$this->view->publicacion = $this->publicacion->listarPublicaciones();
		$this->view->render('index');
	}
	
	public function materias()
	{
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->titulo = 'Administrador de Materias';
		$this->view->materias = $this->materia->listarMaterias();
		$this->view->render('materias');
	}

	public function usuarios()
	{
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->titulo = 'Administrador de Usuarios';
		$this->view->usuarios = $this->usuario->listarUsuarios();
		$this->view->materias = $this->materia->listarMaterias();
		$this->view->render('usuarios');
	}
	
	public function publicaciones()
	{
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->titulo = 'Administrador de Publicaciones';
		$this->view->publicacion = $this->publicacion->listarPublicaciones();
		$this->view->render('publicaciones');
	}
	
	public function comentarios($id)
	{
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->titulo = 'Administrador de Comentarios';
		$this->view->publicacion = $this->publicacion->getPublicacion($id);
		$this->view->comentarios = $this->publicacion->numComentarios($id);
		$this->view->render('comentarios');
	}
	
	public function drive()
	{
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->titulo = 'Administrador de Archivos';
		$this->view->usuarios = $this->usuario->listarUsuarios();
		$this->view->render('drive');
	}
	
}


?>
