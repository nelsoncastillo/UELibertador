<?php

$server = "localhost";
$user = "root";
$pass = "";
$bd = "demo_json";

//Creamos la conexión
include_once("../../php/conexion.php");

$conexion= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
$cadena= "SELECT * FROM usuarios ORDER BY id";
if (!$result = $conexion->consultar($cadena)) die();

//$conexion = mysqli_connect($server, $user, $pass,$bd) 
//or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos la consulta
//$sql = "SELECT * FROM clientes";
//mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

//if(!$result = mysqli_query($conexion, $sql)) die();

$clientes = array(); //creamos un array

while($row = $conexion->registrosArreglo($result)) 
{ 
	$id=$row['id'];
	$nombre=$row['username'];
	$type=$row['type'];
	$email=$row['email'];
	$password=$row['password'];
	
	$clientes[] = array('id'=> $id, 'nombre'=> $nombre, 'type'=> $type, 
						'email'=> $email, 'password'=> $password);

}
	
//desconectamos la base de datos
//$close = mysqli_close($conexion) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  

//Creamos el JSON
//$clientes['clientes'] = $clientes;
$json_string = json_encode($clientes);
echo $json_string;

//Si queremos crear un archivo json, sería de esta forma:

//$file = '../clientes.json';
//file_put_contents($file, $json_string);

	

?>
