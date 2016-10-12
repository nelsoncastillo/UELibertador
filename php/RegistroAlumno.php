<?php 
include_once("conexion.php");

class RegistroAlumno
{ 
public $_alumno; 
public $_representante; 
public $_procedencia; 
public $_vivienda; 
public $_habitacion; 

/*
CREATE TABLE procregistroalumno
(
  alumno character varying(15) NOT NULL,
  representante character varying(15),
  procedencia character varying(15),
  vivienda character varying(15),
  habitacion character varying(15),
  CONSTRAINT pk_alumno PRIMARY KEY (alumno )
  * */
  
public function __construct(){
 $this->_alumno=''; 
 $this->_representante=''; 
 $this->_procedencia=''; 
 $this->_vivienda=''; 
 $this->_habitacion=''; 
		// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
$this->_id=$this->Ultimo() +1;
}
	
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT COUNT(alumno) as maximo FROM procregistroalumno";
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
	$cadena= "SELECT * FROM procregistroalumno where alumno = '$id';";
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
	$cadena= "DELETE FROM procregistroalumno WHERE alumno='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	

	public function Agregar($alumno,$representante,$procedencia,$vivienda,$habitacion){
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO procregistroalumno(alumno, representante, procedencia, vivienda, habitacion ) 
	VALUES ('$alumno','$representante','$procedencia','$vivienda','$habitacion')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla procregistroalumno";	
	//return $resultadoc;	
		}

	public function Actualizar($alumno,$representante,$procedencia,$vivienda,$habitacion){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE procregistroalumno SET alumno='$alumno', representante='$representante', procedencia='$procedencia', vivienda='$vivienda', habitacion='$habitacion' WHERE alumno='$alumno';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla procregistroalumno";	
		}

	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM procregistroalumno where alumno= '$id'";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla procregistroalumno";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_alumno=$rowc->alumno; 
	$this->_representante=$rowc->representante; 
	$this->_procedencia=$rowc->procedencia; 
	$this->_vivienda=$rowc->vivienda; 
	$this->_habitacion=$rowc->habitacion; 
			}
	return 1;	
	}


} 

?>
