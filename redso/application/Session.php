<?php 

class Session
{
	public static function init()
	{
		session_start();
	}

	public static function destroy($key = false)
	{
		if ( $key ) {
			if ( is_array($key) ) {
				for ($i = 0; $i < count($key); $i++) { 
					if ( isset($_SESSION[$key[$i]]) ) {
						unset($_SESSION[$key[$i]]);
					}
				}
			} else {
				if ( isset($_SESSION[$key[$i]]) ) {
					unset($_SESSION[$key]);
				}
			}
		} else {
			session_destroy();
		}
	}

	public static function set($key, $value)
	{
		if ( !empty($key) ) {
			$_SESSION[$key] = $value;
		}
	}

	public static function get($key)
	{
		if ( isset($_SESSION[$key]) ) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}

	public static function access($level)
	{
		if ( !Session::get('autenticado_nutrizion') ) {
			header('Location: ' . BASE_URL . 'error/access/5050');
			exit;
		}

		if ( Session::getLevel($level) > Session::getLevel(Session::getlevel($level)) ) {
			header('Location: ' . BASE_URL . 'error/access/5050');
			exit;
		}
	}

	public static function accessView($level)
	{
		if ( !Session::get('autenticado_nutrizion') ) {
			return false;
		}

		if ( Session::getLevel($level) > Session::getLevel(Session::getlevel($level)) ) {
			return false;
		}

		return true;
	}

	public static function getLevel($level)
	{
		$role['administrador'] = 1;
		$role['especialista'] = 2;

		if ( !array_key_exists($level, $role) ) {
			throw new Exception('Error de acceso');
		} else {
			return $role[$level];
		}
	}

}


?>