<?php 
include_once("conexion.php");

class Usuario
{ 
private $_id; // en tabla id 
private $_username; //en tabla  username
private $_password; //en tabla  password 
private $_email; // en tabla  email 
private $_type; // en tabla  type

	public function ValidarUsuario($nombre, $clave)
	{
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM usuarios WHERE username = '$nombre' and password = '$clave' ";
	//echo "<br>cadena sql: $cadena <br>";
	$tb_usuarios=$con->consultar($cadena);
	$cmdtuples = pg_affected_rows($tb_usuarios);
	if (($tb_usuarios !=-1) and ($cmdtuples>0)){
		//print "USUARIO VALIDO, acceso permitido <br>";
		$data = pg_fetch_object($tb_usuarios);
		$this->_id = $data->id;
		$this->_username=$data->username;
		$this->_password= $data->password;
		$this->_email=$data->email;
		$this->_type=$data->type;
		return true;
		}else{
		//print "Usuaio Invalido, acceso no permitido <br>";
		return false;
		}	
	}

	
	public function get_id(){
		return $this->_id;
	}
	public function get_nombre(){
		return $this->_username;
	}
	public function get_tipo(){
		return $this->_type;
	}
	public function get_email(){
		return $this->_email;
	}


}
