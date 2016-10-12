<?php
include_once("asignarBecas.php");
$Becas= new AsignarBecas;

$modo=$_REQUEST['modo'];

/*
 * Aqui deberia ser una funcion que recibe peticiones de ajax o json
 * con un vector clave valor idalumno, cedulaescolar, serial
 */
 
if($modo=='a'){
 $cedulaescolar=$_REQUEST['cedulaescolar']; 
 $idalumno=$_REQUEST['idalumno']; 
 $Beca=$_REQUEST['Beca']; 
 // echo "paso por Aqui";
if($Becas->Buscar($idalumno)>0){
	//si el alumno esta registrado actualiza los registros
	$Becas->Actualizar($idalumno,$cedulaescolar,$Beca);
}else{
	//si no esta en asignar_Becas, lo agrega
	$Becas->Agregar($idalumno,$cedulaescolar,$Beca);
	}
 
}

if($modo=='e'){
// falta la funcionalidad eliminar registro de alumno en Becas
// $Becas->Eliminar($idalumno);
}

?>

