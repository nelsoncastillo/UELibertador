<?php
include_once("procinscripcion.php");

/*
 * Aqui deberia ser una funcionn que recibe peticiones de ajax o json
 * con un vector clave valor proveniente de procInscripcion.phtml
 * con los valores idgrupo, idinscripcion, idalumno para procesar
 * cada trio como registro unico, validar, guardar o actualizar 
 * segun sea el caso, debe tambien arrojar algun listado de error
 * con los alumnos que estan registrados en un grupo diferente 
 */

$ProcInscrip= new ProcInscripcion;
$modo=$_REQUEST['modo'];

if($modo=='a'){
 $idgrupo=$_REQUEST['idgrupo']; 
 $idalumno=$_REQUEST['idalumno']; 
 $idinscripcion=$_REQUEST['idinscripcion']; 
  
if($ProcInscrip->BuscarAlumno($idalumno)>0){
	//si el alumno esta registrado agrega un mensaje a la vista de errores:
	$ProcInscrip->Cargar($idalumno);
	echo "<br> El Alumno $idalumno ya esta Registrado en Curso $ProcInscrip->_idgrupo";

}else{
	//registra alumno
	//echo "<br>  Registrando alumno $idalumno en curso $idgrupo ";
	$ProcInscrip->Agregar($idgrupo,$idinscripcion,$idalumno);
	}

}

if($modo=='e'){

 session_start();
 $idgrupo=$_SESSION["idgrupo"]; 
 $idinscripcion=$_SESSION["idinscripcion"];
 $idalumno=$_REQUEST['id']; 
 $ProcInscrip->EliminarAlumno($idalumno);
 header('Location: manejoprocinscripcion.php?modo=l&idgrupo='.$idgrupo.'&idinscripcion='.$idinscripcion);

}


if($modo=='b'){
session_start();
 $idinscripcion=$_REQUEST['idinscripcion'];
 $_SESSION["idinscripcion"]= $idinscripcion;
	include_once "grilla.php";
	$ggrupo= new Grilla;
	$ggrupo->set_tabla("procinscripcionview");
	$ggrupo->set_Manejador("manejoprocinscripcion.php");
	$ggrupo->set_sql("SELECT * FROM procinscripcionview where idinscripcion = '$idinscripcion' order by idalumno;");
	$ggrupo->crear_grilla($ggrupo->tabla,1,'idalumno');


}

if($modo=='m'){
 session_start();
 $idgrupo=$_SESSION["idgrupo"];
 $idinscripcion=$_SESSION["idinscripcion"];
 $idalumno=$_REQUEST['id']; 
 echo "No se puede Modificar en esta seccion ";
 

}

if($modo=='l'){
 session_start();
 $idgrupo=$_REQUEST['idgrupo']; 
 $idinscripcion=$_REQUEST['idinscripcion']; 
 //Lista los alumnos registrados en un grupo, bajo una inscripcion especifica.
	include_once "grilla.php";
	$ggrupo= new Grilla;
	$ggrupo->set_tabla("procinscripcionview");
	$ggrupo->set_Manejador("manejoprocinscripcion.php");
	$ggrupo->set_sql("SELECT * FROM procinscripcionview where idgrupo = '$idgrupo' order by idalumno;");
	$ggrupo->crear_grilla($ggrupo->tabla,1,'idalumno');
$_SESSION["idgrupo"]=$idgrupo;
$_SESSION["idinscripcion"]=$idinscripcion;
	
		
}

header("location:phpgrid/gridProcInscripcion.php");

?>

