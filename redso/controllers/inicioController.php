<?php 

class inicioController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->publicacion = $this->loadModel('publicaciones');
		$this->publi = $this->loadModel('publicacion');
		$this->materia = $this->loadModel('materia');
	}

	public function index($com=null,$mat=null)
	{
		$maa = explode("-",$mat);
		$mat = $maa[0];
		if($mat!=null and $mat!=0){
			$this->view->publicacion = $this->publicacion->listarPublicacionesReg($mat);
			Session::set('materia', $mat);
			$this->view->titulo = 'Publicaciones por Materia';
			$this->view->mat = $this->materia->getMateria($mat);
		}else{
			$this->view->publicacion = $this->publicacion->listarPublicaciones();
			Session::set('materia', 0);
			$this->view->titulo = 'Inicio';
		}
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->estudiantes = $this->publicacion->listarUsuarios(1);
		$this->view->docentes = $this->publicacion->listarUsuarios(2);
		$this->view->auxiliares = $this->publicacion->listarUsuarios(3);
		$this->view->administrativos = $this->publicacion->listarUsuarios(4);
		$this->view->materias = $this->materia->listarRegistros(Session::get('id'));
		$this->view->comentario = $com;
		$this->view->render('index');
	}

	/*public function materia($com=null)
	{
		Session::set('materia', 666);
		$this->view->publicacion = $this->publicacion->listarPublicaciones();
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->estudiantes = $this->publicacion->listarUsuarios(1);
		$this->view->docentes = $this->publicacion->listarUsuarios(2);
		$this->view->auxiliares = $this->publicacion->listarUsuarios(3);
		$this->view->materias = $this->materia->listarRegistros();
		$this->view->titulo = 'Publicaciones por Materia';
		$this->view->comentario = $com;
		$this->view->render('index');
	}*/
	
	public function notificaciones($not=0)
	{
		$com=null;
		$datos = array(
			':not_estado'	=>		1,
		);
		$this->publicacion->verificarNotificacion($not,Session::get('id'),$datos);
		$this->view->publicacion = $this->publicacion->listarPublicaciones();
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->estudiantes = $this->publicacion->listarUsuarios(1);
		$this->view->docentes = $this->publicacion->listarUsuarios(2);
		$this->view->auxiliares = $this->publicacion->listarUsuarios(3);
		$this->view->administrativos = $this->publicacion->listarUsuarios(4);
		$this->view->titulo = 'Inicio';
		$this->view->comentario = $com;
		$this->view->render('index');
	}
	
	public function imagenes($id)
	{
		return $this->publicacion->listarImagenes($id);
	}
	
	public function registrar_publicacion()
	{
		date_default_timezone_set('America/La_Paz');
		if($this->getText('pmat')==0){ $tipo = '-1'; }else{ $tipo = $this->getText('pmat'); }
		$datos = array(
			':usu_id'		=>		Session::get('id'),
			':pub_fecha'	=>		date("Y-m-d"),
			':pub_hora'		=>		date("H:i:s"),
			':pub_desc'		=>		nl2br($this->getText('desc')),
			':pub_tipo'	    =>		$tipo,	
			':pub_estado'	=>		1,				
		);

		$res = $this->publicacion->registrarPublicacion($datos);
		
		$imagenes = explode('*', $this->getText('adjuntos'));
		if ( count($imagenes) > 0 ) {
			foreach ($imagenes as $imagen) {
				if($imagen!=''){
					$foto = array(
						'pub_id'	  =>	$res,
						'img_imagen'  =>	$imagen,
					);
					$this->publicacion->adjuntarFoto($foto);
				}
			}
		}
		$usuarios = $this->publi->listarNusuarios(Session::get('id'));
		foreach($usuarios as $usu){ 
			$datos = array(
				':usu_id'		=>		$usu['usu_id'],
				':pub_id'	    =>		$res,
				':not_estado'	=>		0,			
			);
			$this->publicacion->registrarNotificacion($datos);
		}
		date_default_timezone_set('America/La_Paz');
		$datos = array(
			':usu_id'		=>		Session::get('id'),
			':pub_id'		=>		$res,
			':puc_fecha'	=>		date("Y-m-d"),
			':puc_hora'		=>		date("H:i:s")		
		);
		$this->publicacion->registrarCompartir($datos);
		
		$res = ($res) ? 'ok_listar' : 'error';
		if($this->getText('pmat')==0){
			$url = BASE_URL.'inicio';
		}else{
			$url = BASE_URL.'inicio/index/null/'.$this->getText('pmat');
		}
		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	$url,
		));
		//$this->view->render('index');
	}
	
	public function registrar_comentario()
	{
		date_default_timezone_set('America/La_Paz');
		$datos = array(
			':usu_id'		=>		Session::get('id'),
			':pub_id'		=>		$this->getText('pid'),
			':com_fecha'	=>		date("Y-m-d"),
			':com_hora'		=>		date("H:i:s"),
			':com_comentario'=>		$this->getText('comentario'),
			':com_estado'	=>		1,				
		);
		if($this->getText('cus')!=0){
			$cus = $this->getText('cus').'/';	
		}else{
			$cus = '';
		}

		$res = $this->publicacion->registrarComentario($datos);

		$res = ($res) ? 'ok_listarc' : 'error';
		//BASE_URL.$this->getText('ctr').'/index/'.$cus.$this->getText('pid').'/'.rand(0,999).'#pub-'.$this->getText('pid')
		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	BASE_URL.$this->getText('ctr').'/index/'.$this->getText('pid').'/'.$this->getText('mid').'-'.rand(0,999).'#pub-'.$this->getText('pid'),
			'id'            =>  $this->getText('pid')
		));
		//$this->view->render('index');
	}
	
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
			'res'	=>	$res
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
		
		$idn = $res;
		$res = ($res) ? 'ok_like' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'		=>	$res,
			'id'		=>	$this->getText('pid'),
			'tip'		=>  $this->getText('tipo'),
			'idn'		=>	$idn
		));
		//$this->view->render('index');
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
	
	public function sugerencias($id){
		return $this->publicacion->numSugerencias($id);
	}
	
	public function subir_archivos()
    {
        if ( !empty($_FILES) ) {
            /*$config['upload_path'] = $this->upload_path;
            $config['allowed_types'] = "jpg|jpeg|gif|png";
            $config['encrypt_name'] = true;
            $config['max_size'] = '8000';
            $this->load->library('upload', $config);*/
			@unlink($_FILES['file']);	
			$IMG = $_FILES['file']['name'];
			@copy($_FILES['file']['tmp_name'],$_FILES['file']['name']);	
			//rename($_FILES['file']['name'],'../fotos/'.$IMG);
            if (rename($_FILES['file']['name'],'uploads/'.$IMG)) {
				/*$this->output->set_status_header(200);
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode(array('resp' => 'ok', 'info' => $_FILES)));*/
				http_response_code(200);
				header('Content-Type: application/json');
				echo  json_encode(array('resp' => 'ok', 'info' => $_FILES["file"]['name']));
            } else {
				http_response_code(401);
				header('Content-Type: application/json');
				echo  json_encode(array('resp' => 'error', 'info' => $_FILES['file']['error']));
				/*$this->output->set_status_header(401);
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode(array('resp' => 'error', 'info' => "0")));*/
            }
        }
    }

    public function remover_archivos()
    {
        var_dump($this->input->post());
        $archivo = $this->input->post('archivo');
        // var_dump($archivo);
        if ($archivo && file_exists(APPPATH .'..'.$this->DS.'assets'.$this->DS.'archivos'.$this->DS. $archivo)) {
            // echo 'borrando archivo..';
            @unlink(APPPATH .'..'.$this->DS.'assets'.$this->DS.'archivos'.$this->DS. $archivo);
        }
    }
	
	public function eliminar_publicacion()
	{
		$id = $this->getInt('id');
		//$this->publicacion->borrarPublicacion($id);
		$res = $this->publicacion->borrarPublicacion($id);
		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
		));
	}
	
	public function eliminar_comentario()
	{
		$id = $this->getInt('id');
		//$this->publicacion->borrarPublicacion($id);
		$res = $this->publicacion->borrarComentario($id);
		$res = ($res) ? 'ok' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	$res,
		));
	}
	
	public function datos_publicacion($id)
	{
		$id = (int) $id;
		echo json_encode($this->publicacion->getPublicacion($id));
	}
	
	public function modificar_publicacion()
	{
		$id = $this->getText('id');
		$datos = array(
			':pub_desc'=>		$this->getText('mdesc')
		);

		$res = $this->publicacion->actualizarPublicacion($id, $datos);

		$res = ($res) ? 'ok_listar' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'			=>	$res,
			'listar'		=>	'inicio',
		));
	}
	
	public function datos_comentario($id)
	{
		$id = (int) $id;
		echo json_encode($this->publicacion->getComentario($id));
	}
	
	public function modificar_comentario()
	{
		$id = $this->getText('id');
		$datos = array(
			':com_comentario'=>		$this->getText('mcom')
		);

		$res = $this->publicacion->actualizarComentario($id, $datos);

		$res = ($res) ? 'ok_listarmc' : 'error';

		header('Content-Type: application/json');
		echo json_encode(array(
			'res'		=>	$res,
			'id'		=>	$this->getText('id'),
			'com'		=>	$this->getText('mcom'),
		));
	}
}
?>
