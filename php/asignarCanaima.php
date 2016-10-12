<?php
include_once("conexion.php");
// luego de registrar serial de canaima debe ir a tabla alumnos y registrar el campo 
//canaima = 'Si'

class AsignarCanaima
{ 
public $_id; //id alumno 
public $_cedula_escolar; 
public $_serial_canaima; 

/*	
CREATE TABLE asignar_canaima
(
  alumno integer,
  cedulaescolar character varying(20),
  serial_canaima character varying(50)
)	*/

	public function __construct(){
	 $this->_id=''; 
	 $this->_cedula_escolar=''; 
	 $this->_serial_canaima=''; 
			}
	
	public function Buscar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM asignar_canaima where alumno = '$id';";
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
	
	
	public function Eliminar($id){ 
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "DELETE FROM asignar_canaima WHERE alumno='$id';";
	$resultadoc = $con->consultar($cadena); 
	$actualiza_alumnos ="UPDATE alumnos SET canaima='No' WHERE id='$id';";
	if($resultadoc = $con->consultar($actualiza_alumnos)==-1) echo "Error actualizando registro en tabla alumnos";

	}
	
	public function Agregar($id,$cedula_escolar,$serial_canaima){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO asignar_canaima( alumno, cedulaescolar, serial) VALUES ('$id','$cedula_escolar','$serial_canaima');";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla asignar_canaima";	
	//return $resultadoc;	
	$actualiza_alumnos ="UPDATE alumnos SET canaima='Si' WHERE id='$id';";
	if($resultadoc = $con->consultar($actualiza_alumnos)==-1) echo "Error actualizando registro en tabla alumnos";
		}
	
	public function Actualizar($id,$cedula_escolar,$serial_canaima){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE asignar_canaima SET alumno='$id', cedulaescolar='$cedula_escolar', serial='$serial_canaima' WHERE alumno='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla asignar_canaima";
	$actualiza_alumnos ="UPDATE alumnos SET canaima='Si' WHERE id='$id';";
	if($resultadoc = $con->consultar($actualiza_alumnos)==-1) echo "Error actualizando registro en tabla alumnos";
	
		}
		
	
	public function Cargar($id){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM asignar_canaima where alumno= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla asignar_canaima";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->alumno; 
	$this->_cedula_escolar=$rowc->cedulaescolar; 
	$this->_serial_canaima=$rowc->serial_canaima; 

			}
	return 1;	
	}		
	
}		
?>

