<?php 
include_once("conexion.php");

class Inscripcion
{ 
public $_id; 
public $_fecha_inscripcion_inicial; 
public $_anno_escolar; 
public $_docente;
	
	public function __construct(){
		$this->_id=''; 
		$this->_fecha_inscripcion_inicial=''; 
		$this->_anno_escolar=''; 
		$this->_docente='';
			}
	/*
	CREATE TABLE inscripciones
	(
	  id integer NOT NULL,
	  fecha_ins_ini date,
	  anno_escolar character varying,
	  docente_incripcion character varying,
	  CONSTRAINT pk_idinscrpcion PRIMARY KEY (id )
	*/

// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT MAX(id) as maximo FROM inscripciones";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc){
	$cont=$con->contar($resultadoc);
	if($cont<=0){	
		return -1;
		}else{
		$resulta=$con->registros($resultadoc);
		return $resulta->maximo;			
		}
	}else{
		return -2;
		}
	}
	
	public function Buscar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM inscripciones where id = '$id';";
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
	
	public function Eliminar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM inscripciones WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	
  
   
	public function Agregar($id,$fecha_inscripcion,$anno_escolar,$docente_inscripcion){
		//falta
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO inscripciones (id, fecha_ins_ini, anno_escolar, docente_incripcion) VALUES ('$id','$fecha_inscripcion','$anno_escolar','$docente_inscripcion')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla docentes";	
	//return $resultadoc;	
		}

	public function Actualizar($id,$fecha_inscripcion,$anno_escolar,$docente_inscripcion){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE inscripciones SET id='$id', fecha_ins_ini='$fecha_inscripcion', anno_escolar='$anno_escolar', docente_incripcion='$docente_inscripcion' WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla docentes";	
		}

	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM inscripciones where id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla grupos";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id_=$rowc->id; 
	$this->_fecha_inscripcion_inicial=$rowc->fecha_ins_ini; 
	$this->_anno_escolar=$rowc->anno_escolar; 
	$this->_docente=$rowc->docente_incripcion;

			}
	return 1;	
	}		
	
		

	

} 


?>



