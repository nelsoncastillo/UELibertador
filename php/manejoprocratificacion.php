<?php
include_once("procratificacion.php");
$ProcRatificacion= new ProcRatificacion;
$modo=$_REQUEST['modo'];

/*
 * Aqui deberia ser una funcion que recibe peticiones de ajax o json
 * con un vector clave valor proveniente de procratificacion.phtml
 * segun sea el caso, debe tambien arrojar algun listado de error
 * con los alumnos que estan ratificados 
 */
if($modo=='a'){
 $idratificacion=$_REQUEST['idratificacion']; 
 $idalumno=$_REQUEST['idalumno']; 
 $idinscripcion=$_REQUEST['idinscripcion']; 
  
if($ProcRatificacion->BuscarAlumno($idalumno)>0){
	//si el alumno esta registrado agrega un mensaje a la vista de errores:
	echo "<br> El Alumno $idalumno ya esta Ratificado ";

}else{
	//registra alumno actualizando ratificado a true y agregando id_ratificacion
	$ProcRatificacion->Agregar($idalumno,$idratificacion);
	}
 
}

/*

if($modo=='s'){
 $idratificacion=$_REQUEST['idratificacion']; 

if($ProcRatificacion->Buscar($idratificacion)>0){
	//si el alumno esta registrado agrega un mensaje a la vista de errores:
	$ProcRatificacion->Cargar($idratificacion);
	echo "$ProcRatificacion->_id_inscripcion";

}else{
	//no hay registro
	echo "Sin Registro";
	}

}

if($modo=='b'){
 $idratificacion=$_REQUEST['idratificacion'];  
 session_start();
 $_SESSION["idratificacion"]= $idratificacion;
	include_once "grilla.php";
	$ggrupo= new Grilla;
	$ggrupo->set_tabla("procratificacionview");
	$ggrupo->set_Manejador("manejoprocratificacion.php");
	$ggrupo->set_sql("SELECT * FROM procratificacionview where idratificacion = '$idratificacion' order by idalumno;");
	$ggrupo->crear_grilla($ggrupo->tabla,1,'idalumno');
}

if($modo=='e'){

 session_start();
 $idratificacion=$_SESSION["idratificacion"];
 $idalumno=$_REQUEST['id']; 
 $ProcRatificacion->EliminarAlumno($idalumno);
 header('Location: manejoprocratificacion.php?modo=l&idratificacion='.$idratificacion.'&idinscripcion='.$idinscripcion);

}


if($modo=='m'){
 session_start();
 $idratificacion=$_SESSION['idratificacion']; 
 $idinscripcion=$_SESSION['idinscripcion']; 
 $idalumno=$_REQUEST['id']; 
 echo "No se puede Modificar en esta seccion ";
 

}

if($modo=='l'){
 session_start();
 $idratificacion=$_REQUEST['idratificacion']; 
 $idinscripcion=$_REQUEST['idinscripcion']; 
 //Lista los alumnos registrados en un grupo, bajo una inscripcion especifica.
	include_once "grilla.php";
	$ggrupo= new Grilla;
	$ggrupo->set_tabla("procratificacionview");
	$ggrupo->set_Manejador("manejoprocratificacion.php");
	$ggrupo->set_sql("SELECT * FROM procratificacionview where idratificacion = '$idratificacion' order by idalumno;");
	$ggrupo->crear_grilla($ggrupo->tabla,1,'idalumno');
 $_SESSION["idratificacion"]=$idratificacion;
 $_SESSION["idinscripcion"]=$idinscripcion;	
		
}
*/

header("location:phpgrid/gridProcRatificacion.php");


?>

