<?php
include_once("conexion.php");
// luego de registrar becaa debe ir a tabla alumnos y registrar el campo 
//beca = 'Si'

class AsignarBecas
{ 
public $_id; //id alumno 
public $_cedula_escolar; 
public $_beca; 

/*	
CREATE TABLE asignar_beca
(
  alumno integer,
  cedulaescolar character varying(20),
  beca character varying(50)
)
	*/

	public function __construct(){
	 $this->_id=''; 
	 $this->_cedula_escolar=''; 
	 $this->_beca=''; 
			}
	
	public function Buscar($id){ //Listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM asignar_beca where alumno = '$id';";
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
	$cadena= "DELETE FROM asignar_beca WHERE alumno='$id';";
	$resultadoc = $con->consultar($cadena); 
	$actualiza_alumnos ="UPDATE alumnos SET beca='No' WHERE id='$id';";
	if($resultadoc = $con->consultar($actualiza_alumnos)==-1) echo "Error actualizando registro en tabla alumnos";

	}
	
	public function Agregar($id,$cedula_escolar,$beca){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO asignar_beca( alumno, cedulaescolar, beca) VALUES ('$id','$cedula_escolar','$beca');";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla asignar_canaima";	
	//return $resultadoc;	
	$actualiza_alumnos ="UPDATE alumnos SET beca='Si' WHERE id='$id';";
	if($resultadoc = $con->consultar($actualiza_alumnos)==-1) echo "Error actualizando registro en tabla alumnos";
		}
	
	public function Actualizar($id,$cedula_escolar,$beca){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE asignar_beca SET alumno='$id', cedulaescolar='$cedula_escolar', beca='$beca' WHERE alumno='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla asignar_beca";
	$actualiza_alumnos ="UPDATE alumnos SET beca='Si' WHERE id='$id';";
	if($resultadoc = $con->consultar($actualiza_alumnos)==-1) echo "Error actualizando registro en tabla alumnos";
	
		}
		
	
	public function Cargar($id){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM asignar_beca where alumno= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla asignar_beca";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->alumno; 
	$this->_cedula_escolar=$rowc->cedulaescolar; 
	$this->_beca=$rowc->beca; 

			}
	return 1;	
	}		
	
}		
?>

