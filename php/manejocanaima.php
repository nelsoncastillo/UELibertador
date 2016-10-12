<?php
include_once("asignarCanaima.php");
$Canaima= new AsignarCanaima;

$modo=$_REQUEST['modo'];

/*
 * Aqui deberia ser una funcion que recibe peticiones de ajax o json
 * con un vector clave valor idalumno, cedulaescolar, serial
 */
 
if($modo=='a'){
 $cedulaescolar=$_REQUEST['cedulaescolar']; 
 $idalumno=$_REQUEST['idalumno']; 
 $serial=$_REQUEST['serial']; 
  //echo "paso por Aqui";
if($Canaima->Buscar($idalumno)>0){
	//si el alumno esta registrado actualiza los registros
	//echo "<br> El Alumno $idalumno ya esta Ratificado ";
	$Canaima->Actualizar($idalumno,$cedulaescolar,$serial);
}else{
	//si no esta en asignar_canaima, lo agrega
	$Canaima->Agregar($idalumno,$cedulaescolar,$serial);
	}
 
}

if($modo=='e'){
// falta la funcionalidad eliminar registro de alumno en canaima
// $Canaima->Eliminar($idalumno);
}

?>

