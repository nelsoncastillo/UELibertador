<?php 
include_once("conexion.php");

 /*
 * CREATE TABLE procinscripciones
(
  idgrupo character varying(10),
  idinscripcion character varying(10),
  idalumno character varying(10)
 * 
public $_idgrupo; 
public $_idinscripcion; 
public $_idalumno; 	
 * */
 
class ProcInscripcion
{ 
public $_idgrupo; 
public $_idinscripcion; 
public $_idalumno; 
	
	public function __construct(){
	$this->_idgrupo=''; 
	$this->_idinscripcion=''; 
	$this->_idalumno=''; 
		}

	public function BuscarAlumno($id){ 
		//Busca un alumno paar determinar si esta 
		//en algun otro grupo, o aun no se registra en alguno
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procinscripciones where idalumno = '$id';";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc){
	$cont=$con->contar($resultadoc);
	if($cont<=0){	
		return -1;
		}else{
	return $cont;			
		}
	}else{
		return -2;
		}
	}
	
	public function BuscarSeccion($id){ 
		//Busca un alumno paar determinar si esta 
		//en algun otro grupo, o aun no se registra en alguno
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procinscripcionview where idgrupo = '$id';";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc){
	$cont=$con->contar($resultadoc);
	if($cont<=0){	
		return -1;
		}else{
			
	return $resultadoc;		
		}
	}else{
		return -2;
		}
	}
	
	public function Eliminar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM procinscripciones WHERE idinscripcion='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	
  	
  	public function EliminarAlumno($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM procinscripciones WHERE idalumno='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	
	
	public function Agregar($idgrupo,$idinscripcion,$idalumno){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO procinscripciones (idgrupo, idinscripcion, idalumno,ratificado) VALUES ('$idgrupo','$idinscripcion','$idalumno','0')";
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla procinscripciones";	
		}

	public function Actualizar($idgrupo,$idinscripcion,$idalumno){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE procinscripciones SET idgrupo='$idgrupo', idinscripcion='$idinscripcion', idalumno='$idalumno'  
	WHERE idgrupo='$idgrupo' and idalumno='$idalumno' ;";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla procinscripciones";	
		}

	public function Cargar($idalumno){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procinscripciones where  idalumno='$idalumno' ";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla procinscripciones";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_idgrupo=$rowc->idgrupo; 
	$this->_idinscripcion=$rowc->idinscripcion; 
	$this->_idalumno=$rowc->idalumno; 
			}
	return 1;	
	}		
	
	public function VaciarSeccion($id){ 
		//Elimina un grupo completo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM procinscripciones WHERE idgrupo='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	

} 


?>



