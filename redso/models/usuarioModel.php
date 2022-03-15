<?php 

class usuarioModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function listarUsuarios()
	{
		$usuarios = $this->db->query('SELECT * FROM usuarios');
		return $usuarios->fetchAll();
	}

	public function getUsuario($id)
	{
		$id = (int) $id;
		$usuario = $this->db->query('SELECT * FROM usuarios WHERE usu_id = ' . $id);
		return $usuario->fetch();
	}

	public function getRegistros($uid)
	{
		$uid = (int) $uid; 
		$materias = $this->db->query('SELECT * FROM registro WHERE usu_id = ' . $uid);
		return $materias->fetchAll();

	}

	public function getRegistro($uid, $mid)
	{
		$uid = (int) $uid; $mid = (int) $mid;
		$materias = $this->db->query('SELECT * FROM registro WHERE mat_id = ' . $mid . ' and usu_id = ' . $uid);
		if($materias->fetch()){
			return true;
		}else{
			return false;
		}
	}

	public function getUsuarioPersona($id)
	{
		$id = (int) $id;
		$usuario = $this->db->query('SELECT * FROM usuarios WHERE id_personal = ' . $id);
		return $usuario->fetch();
	}

	public function agregarUsuario($datos)
	{
		$this->db->prepare('INSERT INTO usuarios VALUES(null, :id_personal, :usuario, :clave, :tipo, :estado)')
			->execute($datos);
		return $this->db->lastInsertId();
	}
	
	public function agregarUsuarioAdm($datos)
	{
		//'INSERT INTO usuarios (usu_id, usu_nombre, usu_apellido, usu_foto, usu_imagen, usu_tipo, usu_nivel, usu_email, usu_usuario, usu_clave, usu_estado, usu_conectado) VALUES(null, :nombre, :apellido, :foto, :imagen, :tipo, :nivel, :email, :usuario, :clave, :estado, :conectado)'
		$this->db->prepare('INSERT INTO usuarios (usu_id, usu_nombre, usu_apellido, usu_foto, usu_imagen, usu_tipo, usu_nivel, usu_email, usu_usuario, usu_clave, usu_estado, usu_conectado) VALUES(null, :nombre, :apellido, :foto, :imagen, :tipo, :nivel, :email, :usuario, :clave, :estado, :conectado)')
			->execute($datos);
		return $this->db->lastInsertId();
	}

	public function agregarRegistroAdm($datos)
	{
		$this->db->prepare('INSERT INTO registro (reg_id, usu_id, mat_id, reg_estado) VALUES(null, :uid, :mid, 1)')
			->execute($datos);
		return $this->db->lastInsertId();
	}

	public function registrarUsuario($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO usuarios(usu_id, usu_nombre, usu_apellido, usu_email, usu_usuario, usu_clave, usu_estado) VALUES(null, :usu_nombre, :usu_apellido, :usu_email, :usu_usuario, :usu_clave, :usu_estado)')
				->execute($datos);
		return $res;
	}
	
	public function actualizarUsuarioAdm($id, $datos)
	{
		$id = (int) $id;
		$datos[':id'] = $id;
		$res = $this->db->prepare('UPDATE usuarios SET usu_nombre = :nombre, usu_apellido = :apellido, usu_email = :email, usu_foto = :foto, usu_imagen = :imagen, usu_usuario = :usuario, usu_clave = :clave, usu_tipo = :tipo, usu_nivel = :nivel, usu_estado = :estado  WHERE usu_id = :id')
			->execute($datos);
		return $res;
	}
	
	public function actualizarUsuario($id, $datos)
	{
		$id = (int) $id;
		$datos[':id_personal'] = $id;
		$res = $this->db->prepare('UPDATE usuarios SET usuario = :usuario, clave = :clave, tipo = :tipo  WHERE id_personal = :id_personal')
			->execute($datos);

		return $res;
	}
	
	public function actualizarPerfil($id, $datos)
	{
		$id = (int) $id;
		$datos[':usu_id'] = $id;
		$res = $this->db->prepare('UPDATE usuarios SET usu_nombre = :usu_nombre, usu_apellido = :usu_apellido, usu_email = :usu_email, usu_foto = :usu_foto, usu_imagen = :usu_imagen  WHERE usu_id = :usu_id')
			->execute($datos);

		return $res;
	}
	
	public function actualizarClave($id, $datos)
	{
		$id = (int) $id;
		$datos[':usu_id'] = $id;
		$res = $this->db->prepare('UPDATE usuarios SET usu_clave = :usu_clave  WHERE usu_id = :usu_id')
			->execute($datos);
		return $res;
	}

	public function borrarUsuarioPersona($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM usuarios WHERE id_personal = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		
		return $res;
	}

	public function verificarUsuario($usuario, $contrasena)
	{
		/*$sql = 'SELECT * FROM usuarios WHERE usu_usuario = "' . $usuario . '" AND usu_clave = "' . $contrasena .'" AND usu_estado = 1';

		$user = $this->db->query($sql);
		$respuesta = $user->fetch();*/

		$sql = 'SELECT * FROM usuarios WHERE usu_usuario = ? AND usu_clave = ? AND usu_estado = ?';
		$res = $this->db->prepare($sql);
		$res->execute(array($usuario,$contrasena,1));
		$respuesta = $res->fetch(PDO::FETCH_ASSOC);
		
		

		if ( $respuesta ) {
			//session
			Session::set('id', $respuesta['usu_id']);
			Session::set('usuario_id', $respuesta['usu_id']);
			Session::set('usuario', $respuesta['usu_usuario']);
			Session::set('nombre_usuario', $respuesta['usu_nombre'] . ' ' . $respuesta['usu_apellido']);
			Session::set('nivel', $respuesta['usu_tipo']);
			Session::set('adm', $respuesta['usu_nivel']);
			Session::set('foto', $respuesta['usu_foto']);
			Session::set('login_redso', true);

			$datos = array(1,$respuesta['usu_id']);
			
			//$this->db->prepare('UPDATE usuarios SET usu_conectado = :conectado WHERE usu_id = :id_usuario')->execute($datos);
			$this->db->prepare('UPDATE usuarios SET usu_conectado = ? WHERE usu_id = ?')->execute($datos);

			return true;
		} else {
			return false;
		}

	}

	public function noHabilitados()
	{
		$usuarios = $this->db->query('SELECT * FROM usuarios WHERE usu_estado = 0');
		return $usuarios->fetchAll();
	}

	public function actualizarUsuarioRegistrado($id, $datos)
	{
		$id = (int) $id;
		$datos[':usu_id'] = $id;
		$res = $this->db->prepare('UPDATE usuarios SET usu_tipo = :usu_tipo, usu_estado = :usu_estado WHERE usu_id = :usu_id')
			->execute($datos);

		return $res;
	}

	public function desconectarUsuario($usuario)
	{
		$datos = array(
			':conectado'	=>	0,
			':id_usuario'	=>	$usuario
		);

		$res = $this->db->prepare('UPDATE usuarios SET usu_conectado = :conectado WHERE usu_id = :id_usuario')->execute($datos);

		return $res;
	}
	
	public function borrarUsuario($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM usuarios WHERE usu_id = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		
		return $res;
	}

	public function borrarRegistro($uid,$mid)
	{
		$uid = (int) $uid; $mid = (int) $mid;
		$del = $this->db->prepare('DELETE FROM registro WHERE usu_id = :usu_id and mat_id = :mat_id');
		$res = $del->execute(array(
			':usu_id'	=>	$uid,
			':mat_id'	=>	$mid
		));
		
		return $res;
	}


}

?>