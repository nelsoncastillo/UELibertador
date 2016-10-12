<?php 
include_once("conexion.php");

 
class ProcRatificacion
{ 
public $_id; 
public $_fecha_ins_rat; 
public $_id_inscripcion; 
public $_docente_ratifica; 
public $_observaciones; 

/*
 CREATE TABLE ratificaciones
(
  id integer NOT NULL,
  fecha_ins_rat date,
  id_inscripcion character varying,
  docente_ratifica character varying,
  observaciones text,
  CONSTRAINT pk_idratifica PRIMARY KEY (id )
)
  */
	
	public function __construct(){
	$this->_id=''; 
	$this->_fecha_ins_rat=''; 
	$this->_id_inscripcion=''; 
	$this->_docente_ratifica='';
	$this->_observaciones='';
		}

	public function Buscar($id){ 
		//Busca un alumno paar determinar si esta 
		//en algun otro grupo, o aun no se registra en alguno
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM ratificaciones where id = '$id';";
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
	
	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM ratificaciones where  id= '$id' ";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		//echo "Error leyendo registro en tabla ratificaciones";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->id; 
	$this->_fecha_ins_rat=$rowc->fecha_ins_rat; 
	$this->_id_inscripcion=$rowc->id_inscripcion; 
	$this->_docente_ratifica=$rowc->docente_ratifica ;
	$this->_observaciones=$rowc->observaciones ;
			}
	return 1;	
	}		
	
	public function BuscarAlumno($id){ 
		//Busca un alumno paar determinar si esta 
		//en algun otro grupo, o aun no se registra en alguno
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procratificacionview where idalumno = '$id';";
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
	
	public function Agregar($idalumno,$idratificacion){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= " UPDATE procinscripciones SET ratificado='True', idratificacion='$idratificacion' WHERE idalumno='$idalumno' ; ";
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla procinscripciones";	
		}
	
  	public function EliminarAlumno($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM procinscripciones WHERE idalumno='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	
	

	public function VaciarSeccion($id){ 
		//Elimina un grupo completo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM procinscripciones WHERE idgrupo='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	

} 


?>



