<?php 

class chatModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function listarContactos($usuario)
	{
		$contactos = $this->db->query('SELECT * FROM usuarios WHERE usu_id != ' . $usuario);
		return $contactos->fetchAll();
	}
	
	public function listarContactob($usuario,$con)
	{
		//$contactos = $this->db->query('SELECT * FROM seguimiento AS seg INNER JOIN usuarios AS usu ON seg.usu_id = usu.usu_id WHERE seg.use_id = ' . $usuario . ' AND seg.seg_estado = 1');
		if($con!=0){
			$contactos = $this->db->query('SELECT * FROM usuarios WHERE usu_id = ' . $con);
		}else{
			$contactos = $this->db->query('SELECT * FROM usuarios WHERE usu_id != ' . $usuario);
		}
		return $contactos->fetchAll();
	}

	public function listarMensajes($usuario)
	{
		$mensajes = $this->db->query('SELECT * FROM mensajes men WHERE men.usu_id = ' . $usuario . 'ORDER BY men.men_fecha DESC LIMIT 10');
	}

	public function getConversacion($remitente, $consignatario)
	{
		$mensajes = $this->db->query('SELECT * FROM mensajes men LEFT JOIN archivos arc ON men.men_id = arc.men_id WHERE (men.env_id = ' . $remitente . ' AND men.usu_id = ' . $consignatario . ') OR (men.env_id = ' . $consignatario . ' AND men.usu_id = ' . $remitente . ') ORDER BY men.men_fecha DESC LIMIT 10');

		return $mensajes->fetchAll();
	}
	
	public function actualizarConexion($id, $datos)
	{
		$id = (int) $id;
		$datos[':usu_id'] = $id;
		$res = $this->db->prepare('UPDATE usuarios SET usu_conectado = :usu_conectado  WHERE usu_id = :usu_id')
			->execute($datos);
		return $res;
	}

}

?>