<?php 
include_once("conexion.php");

class Docentes
{ 
public $_id; 
public $_nombre; 
public $_tipo; 
public $_cedula; 
public $_telefono; 

/*
CREATE TABLE docentes
(
  id integer NOT NULL, -- autonumerico
  nombre character varying(50) NOT NULL, -- Nombre completo
  tipo character(3), -- Doc - Aux
  cedula character varying(10),
  telefono character varying(14), -- fromato (9999)999-99-99
  CONSTRAINT "doc_PK" PRIMARY KEY (id )
)
*/
public function __construct(){
  $this->_id=''; 
  $this->_tipo=''; 
  $this->_nombre=''; 
  $this->_cedula=''; 
  $this->_telefono=''; 
	
}
	// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT MAX(id) as maximo FROM docentes";
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
	$cadena= "SELECT * FROM docentes where id = '$id';";
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
	$cadena= "DELETE FROM docentes WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	

	public function Agregar($id,$tipo,$cedula,$nombre,$telefono){
		//falta
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO docentes (id, tipo, cedula, nombre, telefono) VALUES ('$id','$tipo','$cedula','$nombre','$telefono')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en tabla docentes";	
	//return $resultadoc;	
		}

	public function Actualizar($id,$tipo,$cedula,$nombre,$telefono){
		//falta
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "UPDATE docentes SET id='$id', tipo='$tipo', cedula='$cedula', nombre='$nombre', telefono='$telefono' WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla docentes";	
		}

	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM docentes where id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla grupos";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id_=$rowc->id; 
	$this->_tipo=$rowc->tipo; 
	$this->_nombre=$rowc->nombre; 
	$this->_cedula=$rowc->cedula;
	$this->_telefono=$rowc->telefono; 
	
			}
	return 1;	
	}


} 

?>
