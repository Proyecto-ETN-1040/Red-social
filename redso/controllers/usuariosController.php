<?php 

class usuariosController extends Controller
{
	private $persona;
	private $usuario;

	public function __construct()
	{
		parent::__construct();
		$this->usuario = $this->loadModel('usuario');
		$this->materia = $this->loadModel('materia');
	}

	public function borrar()
	{
		$id = $this->getInt('id');
		$res = $this->usuario->borrarUsuario($id);
		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
		));
	}
	
	public function vaciar()
	{
		$id = $this->getInt('id');
		$dir=opendir('uploads/usuarios/'.$id);
		$cont = 0; $cond = 0;
	
		while ($file = readdir($dir)){ 
			if ($file != "." && $file != ".."){ 
				if(@unlink("uploads/usuarios/".$id."/".$file)){
					$cond++;
				}
				$cont++;
			}
		}
		$res = 'ok';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
			'drive'	=>	1
		));
	}

	public function agregar_actualizar_usuario()
	{
		$id = $this->getInt('id_personal');
		if ($this->getInt('id') > 0) {
			$datos = array(
				':usuario'		=>		$this->getText('usuario'),
				':clave'		=>		$this->getText('contrasena_anterior'),
				':tipo'			=>		$this->getInt('tipo'),
			);

			if ( strlen($this->getText('contrasena')) > 0 ) {
				$datos[':clave'] = sha1($this->getText('contrasena'));
			}

			$res = $this->usuario->actualizarUsuario($id, $datos);			
		} else {
			$datos = array(
				':id_personal'	=>		$this->getInt('id_personal'),
				':usuario'		=>		$this->getText('usuario'),
				':clave'		=>		sha1($this->getText('contrasena')),
				':tipo'			=>		$this->getInt('tipo'),
				':estado'		=>		1,
			);
			
			$res = $this->usuario->agregarUsuario($datos);
		}

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'		=>	$res,
		));
	}
	
	public function adm_usuario()
	{
		$id = $this->getInt('id');
		
		$foto = $this->getText('fotor');
		if(!empty($_FILES) ) {
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
		
		if ($this->getInt('id') > 0) {
			$datos = array(
				':nombre'		=>	$this->getText('nombre'),
				':apellido'		=>	$this->getText('apellido'),
				':tipo'		    =>	$this->getText('tipo'),
				':nivel'		=>	$this->getText('nivel'),
				':email'		=>	$this->getText('correo'),
				':usuario'		=>	$this->getText('usuario'),
				':estado'		=>	$this->getText('estado'),
				':foto'		    =>	$foto,	
				':imagen'	    =>	$imagen,
			);
			//if ( strlen($this->getText('contrasena')) > 0 ) {
			if ($this->getText('contrasena')!=$this->getText('contrasenar')) {
				$datos[':clave'] = sha1($this->getText('contrasena'));
			}else{
				$datos[':clave'] = $this->getText('contrasena');	
			}
			$res = $this->usuario->actualizarUsuarioAdm($id, $datos);			
		} else {
			$datos = array(
				':nombre'		=>	$this->getText('nombre'),
				':apellido'		=>	$this->getText('apellido'),
				':tipo'		    =>	$this->getText('tipo'),
				':nivel'		=>	$this->getText('nivel'),
				':email'		=>	$this->getText('correo'),
				':usuario'		=>	$this->getText('usuario'),
				':clave'		=>	sha1($this->getText('contrasena')),
				':estado'		=>	$this->getText('estado'),
				':foto'		    =>	$foto,	
				':imagen'	    =>	$imagen,
				':conectado'	=>	0	
			);
			$res = $this->usuario->agregarUsuarioAdm($datos);
			//$res1 = $this->usuario->agregarUsuarioAdm($datos);
		}

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	BASE_URL . 'admin/usuarios',
		));
	}

	public function adm_materias()
	{
		$id = $this->getInt('id');
		
		$materias = $this->materia->listarMaterias();
		if ( count($materias) > 0 ) : 
        	foreach ($materias as $registro) :
        		if($this->getInt('mat'.$registro['mat_id'])){
        			if($this->usuario->getRegistro($id,$registro['mat_id'])!=true){
						$datos = array(
							':uid'		=>	$id,
							':mid'		=>	$this->getText('mat'.$registro['mat_id']),
						);
						$res = $this->usuario->agregarRegistroAdm($datos);
        			}
        		}else{
        			if($this->usuario->getRegistro($id,$registro['mat_id'])==true){
						$res = $this->usuario->borrarRegistro($id,$registro['mat_id']);
        			}
        		}
        	endforeach; 
        endif;

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	BASE_URL . 'admin/usuarios',
		));
	}

	public function verificar()
	{
		$usuario = $this->getText('usuario');
		$contrasena = sha1($this->getText('contrasena'));

		$respuesta = $this->usuario->verificarUsuario($usuario, $contrasena);

		$res = ($respuesta) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'		=>	$res,
			'redirect'	=>	BASE_URL . 'inicio',
		));
	}

	public function registrar()
	{
		$datos = array(
			':usu_nombre'		=>		$this->getText('registro_nombre'),
			':usu_apellido'		=>		$this->getText('registro_apellidos'),
			':usu_email'		=>		$this->getText('registro_email'),
			':usu_usuario'		=>		$this->getText('registro_usuario'),
			':usu_clave'		=>		sha1($this->getText('registro_contrasena')),
			':usu_estado'		=>		0,
		);
		
		$id = $this->usuario->registrarUsuario($datos);

		$res = ($id > 0) ? 'ok' : 'error';
		
		
		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
		));
	}

	public function get_datos_usuario_registrado($usuario)
	{
		$id = (int) $usuario;
		$datos_usuario = $this->usuario->getUsuario($id);

		header('Content-Type: application/json');
		echo json_encode($datos_usuario);
	}

	public function habilitar_usuario_registrado()
	{
		$id = $this->getInt('usuario_id');
		
		$datos = array(
			':usu_tipo'		=>		$this->getText('tipo_usuario'),
			':usu_estado'	=>		1,				
		);

		$res = $this->usuario->actualizarUsuarioRegistrado($id, $datos);

		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'cerra_modal'	=>	'#modal-habiltar-usuario'
		));
	}

	public function login() 
	{
		$this->view->render_login('login');
	}

	public function logout()
	{

		$this->usuario->desconectarUsuario(Session::get('usuario_id'));

		Session::destroy();
		$this->redirect( 'usuarios/login' );
	}
	
	public function datos_usuario($id)
	{
		$id = (int) $id;
		echo json_encode($this->usuario->getUsuario($id));
	}

	public function datos_registro($id)
	{
		$id = (int) $id;
		echo json_encode($this->usuario->getRegistros($id));
	}


}


?>
