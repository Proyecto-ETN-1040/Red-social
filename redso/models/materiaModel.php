<?php 

class materiaModel extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function listarMaterias()
	{
		$materias = $this->db->query('SELECT * FROM materias');
		return $materias->fetchAll();
	}

	public function listarRegistros($id)
	{
		$id = (int) $id;
		$materias = $this->db->query('SELECT * FROM materias AS mat INNER JOIN registro AS reg ON mat.mat_id = reg.mat_id where usu_id = ' . $id);
		return $materias->fetchAll();
	}

	public function getMateria($id)
	{
		$id = (int) $id;
		$materias = $this->db->query('SELECT * FROM materias WHERE mat_id = ' . $id);
		return $materias->fetch();
	}

	public function agregarmaterias($datos)
	{
		$this->db->prepare('INSERT INTO materias VALUES(null, :des, :detalle, :estado)')
			->execute($datos);
		return $this->db->lastInsertId();
	}
	
	public function agregarmateriasAdm($datos)
	{
		//'INSERT INTO materias (mat_id, mat_nombre, mat_apellido, mat_foto, mat_imagen, mat_tipo, mat_nivel, mat_email, mat_materias, mat_clave, mat_estado, mat_conectado) VALUES (null, :nombre, :apellido, :foto, :imagen, :tipo, :nivel, :email, :materias, :clave, :estado, :conectado)'
		$this->db->prepare('INSERT INTO materias (mat_id, mat_desc, mat_detalle, mat_estado) VALUES(null, :des, :detalle, :estado)')
			->execute($datos);
		return $this->db->lastInsertId();
	}

	public function registrarmaterias($datos)
	{
		$res = $this->db
				->prepare('INSERT INTO materias (mat_id, mat_desc, mat_detalle, mat_estado) VALUES(null, :des, :detalle, :estado)')
				->execute($datos);
		return $res;
	}
	
	public function actualizarmateriasAdm($id, $datos)
	{
		$id = (int) $id;
		$datos[':id'] = $id;
		$res = $this->db->prepare('UPDATE materias SET mat_desc = :des, mat_detalle = :detalle, mat_estado = :estado  WHERE mat_id = :id')
			->execute($datos);
		return $res;
	}
	
	public function actualizarmaterias($id, $datos)
	{
		$id = (int) $id;
		$datos[':mat_id'] = $id;
		$res = $this->db->prepare('UPDATE materias SET mat_desc = :des, mat_detalle = :detalle, mat_estado = :estado  WHERE mat_id = :id')
			->execute($datos);
		return $res;
	}
	
	public function borrarMateria($id)
	{
		$id = (int) $id;
		$del = $this->db->prepare('DELETE FROM materias WHERE mat_id = :id');
		$res = $del->execute(array(
			':id'	=>	$id
		));
		
		return $res;
	}

}

?>