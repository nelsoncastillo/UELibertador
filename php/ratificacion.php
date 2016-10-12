<?php 
include_once("conexion.php");

class Ratificacion
{ 
public $_id; 
public $_fecha_ratificacion; 
public $_id_inscripcion; 
public $_docente_ratifica;
public $_observaciones;

	public function __construct(){
	  $this->_id=''; 
	  $this->_fecha_ratificacion=''; 
	  $this->_id_inscripcion=''; 
	  $this->_docente_ratifica=''; 
	  $this->_observaciones=''; 
			}
	/*
	 * CREATE TABLE ratificaciones
	(
	  id integer NOT NULL,
	  fecha_ins_rat date,
	  id_inscripcion character varying,
	  docente_ratifica character varying,
	  observaciones text,
	  CONSTRAINT pk_idratifica PRIMARY KEY (id )
	  * */

	// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT MAX(id) as maximo FROM ratificaciones";
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
	
	public function Eliminar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM ratificaciones WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	

	public function Agregar($id,$fecha_ratificacion,$id_inscripcion,$docente_ratifica,$observaciones){
		//falta
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO ratificaciones 
	(id, fecha_ins_rat, id_inscripcion, docente_ratifica, observaciones) 
	VALUES ('$id','$fecha_ratificacion','$id_inscripcion','$docente_ratifica','$observaciones')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla docentes";	
	//return $resultadoc;	
		}

	public function Actualizar($id,$fecha_ratificacion,$id_inscripcion,$docente_ratifica,$observaciones){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE ratificaciones 
	SET id='$id', fecha_ins_rat='$fecha_ratificacion', id_inscripcion='$id_inscripcion', 
	docente_ratifica='$docente_ratifica', observaciones='$observaciones' 
	WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla docentes";	
		}

	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM ratificaciones where id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla grupos";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->id; 
	$this->_fecha_ratificacion=$rowc->fecha_ins_rat; 
	$this->_id_inscripcion=$rowc->id_inscripcion; 
	$this->_docente_ratifica=$rowc->docente_ratifica; 
	$this->_observaciones=$rowc->observaciones; 
		}
	return 1;	
	}	


	
} 


?>
