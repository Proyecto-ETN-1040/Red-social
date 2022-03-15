<?php 

class chatController extends Controller
{
	private $chat;
	private $upload_path = "./uploads/chat/";

	public function __construct()
	{
		parent::__construct();
		$this->chat = $this->loadModel('chat');
		$this->publicacion = $this->loadModel('publicaciones');
	}

	public function index($con=0)
	{
		$this->view->titulo = 'Chat';
		$this->view->contactob = $this->chat->listarContactob(Session::get('usuario_id'),$con);
		$this->view->contactos = $this->chat->listarContactos(Session::get('usuario_id'));
		$this->view->contactos = $this->chat->listarContactos(Session::get('usuario_id'));
		$this->view->pubn = $this->publicacion->notPublicaciones(Session::get('id'));
		$this->view->usuc = $con;
		$this->view->render('index');
	}

	public function conversacion()
	{
		$conversacion = $this->chat->getConversacion($this->getInt('remitente'), $this->getInt('destinatario'));
		header('Content-Type: application/json');
		echo json_encode($conversacion);
	}

	public function subir_archivo()
	{

		// var_dump($_FILES);
		if ( !empty($_FILES) ) {

			$temp = explode(".", $_FILES["file"]["name"]);
			$newfilename = round(microtime(true)) . '.' . end($temp);
			$nombre_archivo = $_FILES["file"]["name"];
			$nombre_codificado_archivo = $newfilename;
			$tipo_archivo = end($temp);
			$res = move_uploaded_file($_FILES["file"]["tmp_name"], $this->upload_path . $newfilename);
			echo json_encode(array(
				'res' => $res, 
				'data' => array (
					'codigo' => $nombre_codificado_archivo, 
					'nombre' => $nombre_archivo, 
					'tipo' 	 => $tipo_archivo
				)
			));

// //            chmod(APPPATH ."/archivos", 777);
//             $config['upload_path'] = $this->upload_path;
//             $config['allowed_types'] = "*";
// //            $config['allowed_types'] = "gif|jpg|png|doc|docx|xls|xlsx|pdf|mp4|mp3|ogg|mkv|wav|flv|webm|application/x-zip|rar";
//             $config['encrypt_name'] = true;
//             $config['max_size'] = '9048000';
//             $this->load->library('upload', $config);
//             if ( !$this->upload->do_upload('file') ) {
//                 $this->output->set_status_header(401);
//                 $this->output->set_content_type('application/json');
//                 $this->output->set_output(json_encode(array('resp' => 'error', 'info' => $this->upload->display_errors())));
//             } else {
//                 $this->output->set_status_header(200);
//                 $this->output->set_content_type('application/json');
//                 $this->output->set_output(json_encode(array('resp' => 'ok', 'info' => $this->upload->data())));
//             }
		}

	}

	public function descargar_archivo($archivo)
	{
		// descargar archivos
		if (!isset($archivo) || empty($archivo)) {
			exit();
		}
		$root = $this->upload_path."/";
		$file = basename($archivo);
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
			// Definir headers
			header("Content-Type: $type");
			header("Content-Disposition: attachment; filename=$file");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: " . $size);
			// Descargar archivo
			readfile($path);
		} else {
			die("El archivo no existe.");
		}
	}
	
	public function conexion()
	{
		$id = $this->getText('id');
		if($this->getText('est')=='conectado'){
			$est = 1;
		}else{
			$est = 0;
		}
		$datos = array(
			':usu_conectado'=>		$est
		);

		$res = $this->chat->actualizarConexion($id, $datos);

		$res = ($res) ? 'ok' : 'error';
		return $res;
	}

}


?>
