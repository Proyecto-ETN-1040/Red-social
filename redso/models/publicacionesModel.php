<?php 

class publicacionesModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function listarPublicaciones($usuario = null)
	{
		if ( $usuario ) {
			$publicacion = $this->db->query('SELECT * FROM publicacion,publicacion_c,usuarios where pub_estado=1 and publicacion.pub_id=publicacion_c.pub_id and publicacion.usu_id=usuarios.usu_id and publicacion_c.usu_id='. $usuario .' order by puc_fecha desc, puc_hora desc');
			//$publicacion = $this->db->query('SELECT * FROM publicacion,usuarios where pub_estado=1 and publicacion.usu_id=usuarios.usu_id and usuarios.usu_id='. $usuario .' order by pub_fecha desc, pub_hora desc');
		}else{
			$publicacion = $this->db->query('SELECT * FROM publicacion,usuarios where pub_estado=1 and publicacion.usu_id=usuarios.usu_id order by pub_fecha desc, pub_hora desc');
		}
		return $publicacion->fetchAll();
	}

	public function listarPublicacionesReg($mat)
	{
		$publicacion = $this->db->query('SELECT * FROM publicacion,usuarios where pub_tipo='. $mat .' and pub_estado=1 and publicacion.usu_id=usuarios.usu_id order by pub_fecha desc, pub_hora desc');
		return $publicacion->fetchAll();
	}
	
	public function notPublicaciones($usuario)
	{
		if ($usuario) {
			//$publicacion = $this->db->query('SELECT * FROM publicacion,usuarios where pub_estado=1 and publicacion.usu_id=usuarios.usu_id and publicacion.usu_id!='.$usuario.' order by pub_fecha desc, pub_hora desc');
			$publicacion = $this->db->query('SELECT *,publicacion.usu_id as uid FROM publicacion,usuarios,notificaciones where pub_estado=1 and not_estado=0 and publicacion.usu_id=usuarios.usu_id and publicacion.pub_id=notificaciones.pub_id and notificaciones.usu_id='.$usuario.' order by pub_fecha desc, pub_hora desc');
			return $publicacion->fetchAll();
		}
	}
	
	public function listarUsuarios($usuario)
	{
		$usuarios = $this->db->query('SELECT * FROM usuarios where usu_tipo='. $usuario .' order by usu_nombre asc, usu_apellido asc');
		return $usuarios->fetchAll();
	}

	public function registrarPublicacion($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO publicacion(usu_id, pub_fecha, pub_hora, pub_desc, pub_tipo, pub_estado) VALUES(:usu_id, :pub_fecha, :pub_hora, :pub_desc, :pub_tipo, :pub_estado)')
				->execute($datos);
		return $this->db->lastInsertId();
	}
	
	public function registrarNotificacion($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO notificaciones(usu_id, pub_id, not_estado) VALUES(:usu_id, :pub_id, :not_estado)')
				->execute($datos);
		return $this->db->lastInsertId();
	}
	
	public function verificarNotificacion($id, $usu, $datos)
	{
		$id = (int) $id; $usu = (int) $usu;
		if($id!=0){
			$datos[':not_id'] = $id; 
			$res = $this->db->prepare('UPDATE notificaciones SET not_estado = :not_estado WHERE not_id = :not_id')
				->execute($datos);
		}else{
			$datos[':usu_id'] = $usu;
			$res = $this->db->prepare('UPDATE notificaciones SET not_estado = :not_estado WHERE usu_id = :usu_id')
				->execute($datos);
		}
		//return $res;
	}
	
	public function adjuntarFoto($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO imagenes(pub_id, img_imagen) VALUES(:pub_id, :img_imagen)')
				->execute($datos);
		return $res;
	}
	
	public function registrarComentario($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO comentarios(usu_id, pub_id, com_fecha, com_hora, com_comentario, com_estado) VALUES(:usu_id, :pub_id, :com_fecha, :com_hora, :com_comentario, :com_estado)')
				->execute($datos);
		return $res;
	}
	
	public function registrarCompartir($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO publicacion_c(usu_id, pub_id, puc_fecha, puc_hora) VALUES(:usu_id, :pub_id, :puc_fecha, :puc_hora)')
				->execute($datos);
		return $res;
	}
	
	public function registrarLike($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO likes(usu_id, pub_id) VALUES(:usu_id, :pub_id)')
				->execute($datos);
		return $this->db->lastInsertId();
		//return $res;
	}
	
	public function borrarLike($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM likes WHERE lik_id = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		return $res;
	}
	
	public function numComentarios($id)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT * FROM comentarios,usuarios WHERE comentarios.usu_id=usuarios.usu_id and pub_id = ' . $id . ' order by com_fecha desc, com_hora desc');
		return $num->fetchAll();
	}
	
	public function numLikes($id)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT * FROM likes,usuarios WHERE likes.usu_id=usuarios.usu_id and pub_id = ' . $id . ' order by usu_nombre asc, usu_apellido asc');
		return $num->fetchAll();
	}
	
	public function numSeguidores($id)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT * FROM seguimiento,usuarios WHERE seguimiento.usu_id=usuarios.usu_id and use_id = ' . $id . ' order by usu_nombre asc, usu_apellido asc');
		return $num->fetchAll();
	}
	
	public function numSiguiendo($id)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT * FROM seguimiento,usuarios WHERE seguimiento.use_id=usuarios.usu_id and seguimiento.usu_id = ' . $id . ' order by usu_nombre asc, usu_apellido asc');
		return $num->fetchAll();
	}
	
	public function verSiguiendo($id,$ids)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT * FROM seguimiento,usuarios WHERE seguimiento.use_id=usuarios.usu_id and seguimiento.usu_id = ' . $id . ' and use_id = ' . $ids . ' order by usu_nombre asc, usu_apellido asc');
		return $num->fetch();
	}
	
	public function verLikes($id,$idp)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT * FROM likes,usuarios WHERE likes.usu_id=usuarios.usu_id and usuarios.usu_id = ' . $id . ' and pub_id = ' . $idp . ' order by usu_nombre asc, usu_apellido asc');
		return $num->fetch();
	}
	
	public function numSugerencias($id)
	{
		$id = (int) $id;
		$num = $this->db->query('SELECT *,count(pub_id) FROM publicacion,usuarios WHERE publicacion.usu_id=usuarios.usu_id and usuarios.usu_id <> ' . $id . ' group by usu_nombre,usu_apellido order by count(pub_id) desc limit 0,20'); //SELECT *,count(pub_id) FROM publicacion,usuarios WHERE publicacion.usu_id=usuarios.usu_id and usuarios.usu_id <> 1 group by usu_nombre,usu_apellido order by count(pub_id) desc
		return $num->fetchAll();
	}
	
	public function listarImagenes($id)
	{
		$imgs = $this->db->query('SELECT * FROM imagenes where pub_id='.$id);
		return $imgs->fetchAll();
	}
	
	public function registrarSeguir($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO seguimiento(usu_id, use_id, seg_estado) VALUES(:usu_id, :use_id, :seg_estado)')
				->execute($datos);
		return $res;
	}

	public function borrarSeguir($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM seguimiento WHERE seg_id = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		return $res;
	}
	
	
	public function borrarPublicacion($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM publicacion WHERE pub_id = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		
		return $res;
	}

	public function borrarComentario($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM comentarios WHERE com_id = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		
		return $res;
	}
	
	public function getPublicacion($id)
	{
		$id = (int) $id;
		$usuario = $this->db->query('SELECT * FROM publicacion WHERE pub_id = ' . $id);
		return $usuario->fetch();
	}
	
	public function actualizarPublicacion($id, $datos)
	{
		$id = (int) $id;
		$datos[':pub_id'] = $id;
		$res = $this->db->prepare('UPDATE publicacion SET pub_desc = :pub_desc  WHERE pub_id = :pub_id')
			->execute($datos);

		return $res;
	}
	
	public function getComentario($id)
	{
		$id = (int) $id;
		$usuario = $this->db->query('SELECT * FROM comentarios WHERE com_id = ' . $id);
		return $usuario->fetch();
	}
	
	public function actualizarComentario($id, $datos)
	{
		$id = (int) $id;
		$datos[':com_id'] = $id;
		$res = $this->db->prepare('UPDATE comentarios SET com_comentario = :com_comentario  WHERE com_id = :com_id')
			->execute($datos);

		return $res;
	}

}

?>