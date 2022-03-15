<?php 

class driveController extends Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->chat = $this->loadModel('chat');
		$this->publicacion = $this->loadModel('publicaciones');
		$this->materia = $this->loadModel('materia');
	}

	public function index($mat=0)
	{
		$this->view->titulo = 'Drive';
		/*$this->view->contactob = $this->chat->listarContactob(Session::get('usuario_id'),$con);
		$this->view->contactos = $this->chat->listarContactos(Session::get('usuario_id'));
		$this->view->contactos = $this->chat->listarContactos(Session::get('usuario_id'));*/
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->materias = $this->materia->listarRegistros(Session::get('id'));
		//$this->view->usuc = $con;
		$this->view->dmat = $mat;
		$this->view->render('index');
	}
	
	public function upload($id,$idm=0){
		ini_set('upload_max_filesize', '2M');
		ini_set('post_max_size', '8M');
		ini_set('max_execution_time', '30');
		ini_set('memory_limit', '64M');
		if ( !empty($_FILES) ) {
			//@unlink($_FILES['file']);	
			$IMG = $_FILES['file']['name'];
			@copy($_FILES['file']['tmp_name'],$_FILES['file']['name']);	
			//rename($_FILES['file']['name'],'../fotos/'.$IMG);
			if($idm==0){
				$url = 'usuarios/'.$id;
				$enl = 'drive';
			}else{
				$url = 'materias/'.$idm;
				$enl = 'drive/index/'.$idm;
			}
            if (rename($_FILES['file']['name'],'uploads/'.$url.'/'.$IMG)) {
				/*http_response_code(200);
				header('Content-Type: application/json');
				echo  json_encode(array('resp' => 'ok', 'info' => $_FILES["file"]['name']));*/
				header('Content-Type: application/json');
				echo json_encode(array(
					'res'			=>	'ok_listar',
					'listar'		=>	BASE_URL.$enl,
				));
            } else {
				/*http_response_code(401);
				header('Content-Type: application/json');
				echo  json_encode(array('resp' => 'error', 'info' => $_FILES['file']['error']));*/
				header('Content-Type: application/json');
				echo json_encode(array(
					'res'			=>	'error',
					'listar'		=>	BASE_URL.$enl,
				));
            }
        }
	}
	
	public function download($tip,$id,$file){
		if (!isset($file) || empty($file)) {
		 exit();
		}
		$root = "uploads/".$tip."/".$id."/";
		$file = basename($file);
		$path = $root.$file;
		$type = '';
		 
		if (is_file($path)) {
		 $size = filesize($path);
		 if (function_exists('mime_content_type')) {
		 $type = mime_content_type($path);
		 } else if (function_exists('finfo_file')) {
		 $info = finfo_open(FILEINFO_MIME);
		 $type = finfo_file($info, $path);
		 finfo_close($info);
		 }
		 if ($type == '') {
		 $type = "application/force-download";
		 }
		 // Define los headers
		 header("Content-Type: $type");
		 header("Content-Disposition: attachment; filename=$file");
		 header("Content-Transfer-Encoding: binary");
		 header("Content-Length: " . $size);
		 // Descargar el archivo
		 readfile($path);
		} else {
		 die("El archivo no existe.");
		}
	}
	
	public function remove($id){
		//chdir($path_to_file);
		$file = $_POST["id"];
		@unlink("uploads/usuarios/".$id."/".$file);
		header('Content-Type: application/json');
		echo json_encode(array(
			'res'	=>	'ok',
		));
       /* if(@unlink("uploads/usuarios/".$id."/".$file == true)){
			header('Content-Type: application/json');
			echo json_encode(array(
				'res'	=>	'ok',
			));
		}else{
			header('Content-Type: application/json');
			echo json_encode(array(
				'res'	=>	'error',
			));

		}*/
	}

}


?>
