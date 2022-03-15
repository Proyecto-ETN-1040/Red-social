<?php 

class publicacionModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function listarPublicaciones($usuario = null)
	{
		if ( $usuario ) {
			$publicaciones = $this->db->query();
			return $publicaciones->featchAll();
		}

		return null;
	}

	public function listarUsuarios()
	{
		$usuarios = $this->db->query('SELECT * FROM usuarios');
		return $usuarios->fetchAll();
	}
	
	public function listarNusuarios($usuario)
	{
		$usuarios = $this->db->query('SELECT * FROM usuarios where usu_id!='.$usuario);
		return $usuarios->fetchAll();
	}

	public function getUsuario($id)
	{
		$id = (int) $id;
		$usuario = $this->db->query('SELECT * FROM usuarios WHERE usu_id = ' . $id);
		return $usuario->fetch();
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

	public function registrarUsuario($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO usuarios(usu_id, usu_email, usu_usuario, usu_clave, usu_estado) VALUES(null, :usu_email, :usu_usuario, :usu_clave, :usu_estado)')
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

		$user = $this->db->query('SELECT * FROM usuarios WHERE usu_usuario = "' . $usuario . '" AND usu_clave = "' . $contrasena .'" AND usu_estado = 1');
		$respuesta = $user->fetch();

		if ( $respuesta ) {
			//session
			Session::set('usuario', $respuesta['usu_usuario']);
			Session::set('nombre_usuario', $respuesta['usu_nombre'] . ' ' . $respuesta['usu_apellido']);
			Session::set('nivel', $respuesta['usu_tipo']);
			Session::set('login_redso', true);

			return true;
		} else {
			return false;
		}


	}

}

?>