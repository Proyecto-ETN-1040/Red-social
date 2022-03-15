<?php 

class perfilController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->publicacion = $this->loadModel('publicaciones');
		$this->publi = $this->loadModel('publicacion');
		$this->usuario = $this->loadModel('usuario');
	}

	public function index($usu=null,$com=null)
	{
		if($usu==null){ $usu = Session::get('id'); }
		$this->view->publicacion = $this->publicacion->listarPublicaciones($usu);
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->usuario = $this->publi->getUsuario($usu);
		$this->view->titulo = 'Perfil de Usuario';
		$this->view->comentario = $com;
		$this->view->perfil = $usu;
		$this->view->render('index');
	}
	
	public function notificaciones($not=0,$usu=null)
	{
		$com=null;
		$datos = array(
			':not_estado'	=>		1,
		);
		$this->publicacion->verificarNotificacion($not,Session::get('id'),$datos);
		if($usu==null){ $usu = Session::get('id'); }
		$this->view->publicacion = $this->publicacion->listarPublicaciones($usu);
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->usuario = $this->publi->getUsuario($usu);
		$this->view->titulo = 'Perfil de Usuario';
		$this->view->comentario = $com;
		$this->view->perfil = $usu;
		$this->view->render('index');
	}
	
	public function imagenes($id)
	{
		return $this->publicacion->listarImagenes($id);
	}
	
	public function comentarios($id){
		return $this->publicacion->numComentarios($id);
	}
	
	public function likes($id){
		return $this->publicacion->numLikes($id);
	}
	
	public function seguidores($id){
		return $this->publicacion->numSeguidores($id);
	}
	
	public function siguiendo($id){
		return $this->publicacion->numSiguiendo($id);
	}
	
	public function likes_v($id,$idp){
		return $this->publicacion->verLikes($id,$idp);
	}
	
	public function siguiendo_v($id,$ids){
		return $this->publicacion->verSiguiendo($id,$ids);
	}
	
	public function registrar_seguir()
	{
		if($this->getText('tipo')==0){
			date_default_timezone_set('America/La_Paz');
			$datos = array(
				':usu_id'		=>		Session::get('id'),
				':use_id'		=>		$this->getText('sid'),
				':seg_estado'	=>		1,				
			);
			$res = $this->publicacion->registrarSeguir($datos);
		}else{
			$id = $this->getText('tipo');
			$res = $this->publicacion->borrarSeguir($id);
		}
		$res = ($res) ? 'ok_listar' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	BASE_URL.'perfil/index/'.$this->getText('sid')
		));
		//$this->view->render('index');
	}
	
	/*********/
	public function registrar_compartir()
	{
		date_default_timezone_set('America/La_Paz');
		$datos = array(
			':usu_id'		=>		Session::get('id'),
			':pub_id'		=>		$this->getText('pid'),
			':puc_fecha'	=>		date("Y-m-d"),
			':puc_hora'		=>		date("H:i:s")		
		);

		$res = $this->publicacion->registrarCompartir($datos);

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res
		));
		//$this->view->render('index');
	}
	
	public function registrar_like()
	{
		if($this->getText('tipo')==0){
			date_default_timezone_set('America/La_Paz');
			$datos = array(
				':usu_id'		=>		Session::get('id'),
				':pub_id'		=>		$this->getText('pid')	
			);
			$res = $this->publicacion->registrarLike($datos);
		}else{
			$id = $this->getText('tipo');
			$res = $this->publicacion->borrarLike($id);
		}

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res
		));
		//$this->view->render('index');
	}
	
	public function editar_perfil()
	{
		$foto = $this->getText('fotor');
		if (!empty($_FILES) ) {
			@unlink($_FILES['foto']);	
			$IMG = $_FILES['foto']['name'];
			@copy($_FILES['foto']['tmp_name'],$_FILES['foto']['name']);	
			//rename($_FILES['file']['name'],'../fotos/'.$IMG);
            if (@rename($_FILES['foto']['name'],'uploads/usuarios/'.$IMG)) {
				$foto = $_FILES['foto']['name'];
				//echo  $_FILES["foto"]['name'];
				//echo  json_encode(array('resp' => 'error', 'info' => $_FILES['file']['error']));
            }
		}
		
		$imagen = $this->getText('imagenr');
		if (!empty($_FILES) ) {
			@unlink($_FILES['imagen']);	
			$IMG = $_FILES['imagen']['name'];
			@copy($_FILES['imagen']['tmp_name'],$_FILES['imagen']['name']);	
            if (@rename($_FILES['imagen']['name'],'uploads/usuarios/'.$IMG)) {
				$imagen = $_FILES['imagen']['name'];
            }
		}
		
		$id = Session::get('id');
		$datos = array(
			':usu_nombre'	=>	$this->getText('nombre'),
			':usu_apellido'	=>	$this->getText('apellido'),
			':usu_email'	=>	$this->getText('correo'),
			':usu_foto'		=>	$foto,	
			':usu_imagen'	=>	$imagen,			
		);

		$res = $this->usuario->actualizarPerfil($id, $datos);
		
		$res = ($res) ? 'ok_listar' : 'error';
		
		Session::set('nombre_usuario', $this->getText('nombre').' '.$this->getText('apellido'));

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	BASE_URL.'perfil',
		));
		//$this->view->render('index');
	}
	
	public function editar_clave()
	{
		
		$id = Session::get('id');
		$datos = array(
			':usu_clave'	=>	sha1($this->getText('nueva_contrasena')),		
		);

		$res = $this->usuario->actualizarClave($id, $datos);
		
		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
		));
		//$this->view->render('index');
	}
}

?>
