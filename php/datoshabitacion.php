<?php 
include_once("conexion.php");

class DatosHabitacion
{ 
public $_id; 
public $_estado; 
public $_municipio; 
public $_parroquia; 
public $_tipo_vivienda; 
public $_zona; 

	public function __construct(){
	 $this->_id=''; 
	 $this->_estado=''; 
	 $this->_municipio='';  
	 $this->_parroquia=''; 
	 $this->_tipo_vivienda=''; 
	 $this->_zona=''; 
		// aqui puede buscar el ultimo de la tabla para tener el siguiente id disponible....
		$this->_id=$this->Ultimo() +1;
		}

	public function Actualizar($id,$estado,$municipio,$parroquia,$tipo_vivienda,$zona){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena="UPDATE datos_habitacion SET id='$id', estado='$estado', municipio='$municipio', parroquia='$parroquia', tipo_vivienda='$tipo_vivienda', zona='$zona' WHERE id='$id'";
	$resultadoc = $con->consultar($cadena); 	
	if($resultadoc==-1) echo "Error actualizando registro en tabla datos_habitacion";	
		}
		
	public function Agregar($id,$estado,$municipio,$parroquia,$tipo_vivienda,$zona){//listo
	//$id no deberia saberlo el usuario	
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "INSERT INTO datos_habitacion (id, estado, municipio,parroquia,tipo_vivienda,zona) VALUES ('$id','$estado','$municipio','$parroquia','$tipo_vivienda','$zona')";
	// deve validar que se afecto la tabla, 
	if($resultadoc = $con->consultar($cadena)==-1) echo "Error agregando registro en datos_habitacion";	
	//return $resultadoc;	
		}	
		
	public function Ultimo(){
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT MAX(id) as maximo FROM datos_habitacion";
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
	$cadena= "SELECT * FROM datos_habitacion where id = '$id';";
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
	$cadena= "DELETE FROM datos_habitacion WHERE id='$id';";
	$resultadoc = $con->consultar($cadena); 	
	}	
		
/*
CREATE TABLE datos_habitacion
(
  id integer NOT NULL,
  estado character varying,
  municipio character varying,
  parroquia character varying,
  tipo_vivienda text,
  zona character varying,
  CONSTRAINT pk_id_procedencia PRIMARY KEY (id )
 * */
	public function Cargar($id){//listo
	$con= new Conector_pg('127.0.0.1', 'UELibertador', 'junior', 'junior');
	$cadena= "SELECT * FROM datos_habitacion WHERE id= $id";
	$resultadoc = $con->consultar($cadena); 
	if($resultadoc==-1){
		echo "Error leyendo registro en tabla datos_habitacion";	
		return -1;
		}else{
	//carga el objeto con los datos de la db
	$rowc=$con->registros($resultadoc);
	$this->_id=$rowc->id;
	$this->_estado=$rowc->estado; 
	$this->_municipio=$rowc->municipio; 
	$this->_parroquia=$rowc->parroquia; 
	$this->_tipo_vivienda=$rowc->tipo_vivienda; 
	$this->_zona=$rowc->zona; 
			}
	return 1;	
	}	

	

} 


?>



